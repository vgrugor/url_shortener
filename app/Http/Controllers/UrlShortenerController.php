<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Repositories\Contracts\IUrlRepository;
use App\Services\Contracts\IShortUrlGenerator;

class UrlShortenerController extends Controller
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function getShortUrl(UrlShortenerRequest $request, IShortUrlGenerator $urlShortGenerator)
    {
        $shortUrl = $urlShortGenerator->getShortUrl();
        $url = $request->input('url');
        $domain = parse_url($request->input('url'), PHP_URL_HOST);

        $this->urlRepository->add($shortUrl, $url, $domain);

        $link = $request->getHost() . '/' . $shortUrl;

        return view('dashboard')->with(['link' => $link]);
    }
}
