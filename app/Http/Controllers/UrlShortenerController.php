<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Services\ShortUrlFactory;
use App\Services\UrlService;

class UrlShortenerController extends Controller
{
    public function getShortUrl(UrlShortenerRequest $request, ShortUrlFactory $shortUrlFactory)
    {
        $shortener = $shortUrlFactory->getShortenerStrategy();

        $shortUrl = $shortener->create();

        return view('dashboard')->with([
            'linkName' => $request->getHost() . '/' . $shortUrl,
            'link' => $shortUrl,
        ]);
    }

    public function redirect(UrlService $service, string $shortUrl)
    {
        $longUrl = $service->getRedirectUrl($shortUrl);

        if (!empty($longUrl)) {
            return redirect($longUrl);
        }

        return redirect('/');
    }
}
