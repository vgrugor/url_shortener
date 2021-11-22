<?php

namespace App\Services;

use App\Repositories\Contracts\IUrlRepository;
use App\Services\Contracts\IShortUrlGenerator;
use Illuminate\Support\Facades\Auth;

class UrlService
{
    private IUrlRepository $urlRepository;
    private IShortUrlGenerator $shortUrlGenerator;

    public function __construct(IUrlRepository $urlRepository, IShortUrlGenerator $shortUrlGenerator)
    {
        $this->urlRepository = $urlRepository;
        $this->shortUrlGenerator = $shortUrlGenerator;
    }

    public function getShortUrl(string $url): string
    {
        do {
            $shortUrl = $this->shortUrlGenerator->generate();
        } while (!$this->checkUniqueness($shortUrl));

        $this->save($shortUrl, $url);

        return $shortUrl;
    }

    private function save(string $shortKey, string $url): void
    {
        $domain = parse_url($url, PHP_URL_HOST);

        $userId = Auth::id();

        $this->urlRepository->save($userId, $shortKey, $url, $domain);
    }

    private function checkUniqueness(string $shortKey): bool
    {
        $duplicate = $this->urlRepository->getUrlByShortKey($shortKey);
        if ($duplicate) {
            return false;
        }

        return true;
    }

    public function getRedirectUrl(string $shortKey): string
    {
        return ($this->urlRepository->getUrlByShortKey($shortKey))->url;
    }
}
