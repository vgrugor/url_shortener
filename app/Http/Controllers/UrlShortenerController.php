<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Repositories\Contracts\IUrlRepository;
use App\Services\Contracts\IUrlShortener;

class UrlShortenerController extends Controller
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function getShortUrl(UrlShortenerRequest $request, IUrlShortener $urlShortGenerator)
    {
        $shortUrl = $urlShortGenerator->getShortUrl();
        $url = $request->input('url');
        $domain = parse_url($request->input('url'), PHP_URL_HOST);

        $this->urlRepository->add($shortUrl, $url, $domain);

        return view('dashboard')->with(['url' => $shortUrl]);
    }
}
