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

        $linkName = $request->getHost() . '/' . $shortUrl;
        $link = '/' . $shortUrl;

        return view('dashboard')->with(['linkName' => $linkName, 'link' => $link]);
    }

    public function redirect(string $shortUrl)
    {
        $urls = $this->urlRepository->getAllByShortUrl($shortUrl);

        foreach ($urls as $url) {
            if ($url->short_key === $shortUrl) {
                return redirect($url->url);
            }
        }

        return redirect('/');
    }
}
