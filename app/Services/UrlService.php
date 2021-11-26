<?php

namespace App\Services;

use App\Repositories\Contracts\IUrlRepository;
use App\Services\Contracts\IShortUrlGenerator;

class UrlService
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository, IShortUrlGenerator $shortUrlGenerator)
    {
        $this->urlRepository = $urlRepository;
    }

    // TODO: delete class???

    public function getRedirectUrl(string $shortKey): string
    {
        return ($this->urlRepository->getUrlByShortKey($shortKey))->url;
    }
}
