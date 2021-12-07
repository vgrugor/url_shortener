<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Repositories\Contracts\IUrlRepository;
use App\Services\Shortener\ShortenerDataTransformer;
use App\Services\Shortener\ShortUrlFactory;
use Auth;

class UrlShortenerController extends Controller
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function index()
    {
        $top = $this->urlRepository->getPopularUrlByUser(Auth::id());

        return view('dashboard',
            ['top' => $top]
        );
    }

    public function getShortUrl(UrlShortenerRequest $request, ShortUrlFactory $shortUrlFactory)
    {
        $dto = (new ShortenerDataTransformer())->fromRequest($request);

        $shortener = $shortUrlFactory->getShortenerStrategy($dto);

        $shortUrl = $shortener->create($dto);

        $top = $this->urlRepository->getPopularUrlByUser(Auth::id());

        return view('dashboard')->with([
            'linkName' => $request->getHost() . '/' . $shortUrl,
            'link' => $shortUrl,
            'top' => $top,
        ]);
    }
}
