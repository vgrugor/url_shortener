<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Services\UrlService;

class UrlShortenerController extends Controller
{
    private UrlService $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    public function getShortUrl(UrlShortenerRequest $request)
    {
        $shortUrl = $this->urlService->getShortUrl($request->input('url'));

        return view('dashboard')->with(['linkName' => $shortUrl, 'link' => $shortUrl]);
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
