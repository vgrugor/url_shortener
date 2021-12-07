<?php

namespace App\Services;

use App\Models\Url;
use App\Repositories\Contracts\IUrlRepository;
use App\Services\Shortener\Contracts\IShortUrlGenerator;

class UrlRedirector
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository, IShortUrlGenerator $shortUrlGenerator)
    {
        $this->urlRepository = $urlRepository;
    }

    public function getRedirectUrl(string $shortKey): ?Url
    {
        return $this->urlRepository->getUrlByShortKey($shortKey);
    }

    public function getRedirectSecretUrl(string $shortKey, string $secretKey): ?Url
    {
        return $this->urlRepository->getSecretUrlByShortKey($shortKey, $secretKey);
    }
}
