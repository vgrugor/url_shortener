<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Services\ShortUrlFactory;

class UrlShortenerController extends Controller
{
    public function getShortUrl(UrlShortenerRequest $request, ShortUrlFactory $shortUrlFactory)
    {
        $shortener = $shortUrlFactory->getShortenerStrategy();

        $shortener->create();

        dd();

        return view('dashboard')->with([
            'linkName' => $request->getHost() . '/' . $shortUrl,
            'link' => $shortUrl,
        ]);
    }

    public function redirect(string $shortUrl)
    {
        $longUrl = $this->urlService->getRedirectUrl($shortUrl);

        if (!empty($longUrl)) {
            return redirect($longUrl);
        }

        return redirect('/');
    }
}
