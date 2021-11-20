<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Services\Contracts\IUrlShortener;

class UrlShortenerController extends Controller
{
    public function getShortUrl(UrlShortenerRequest $request, IUrlShortener $urlShortenerService)
    {
        $shortUrl = $urlShortenerService->getShortUrl($request->input('url'));

        return view('dashboard')->with(['url' => $shortUrl]);
    }
}
