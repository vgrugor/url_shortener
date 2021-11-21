<?php

namespace App\Services;

use App\Repositories\Contracts\IUrlRepository;
use App\Services\Contracts\IShortUrlGenerator;
use Illuminate\Database\Eloquent\Collection;

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

        $domain = parse_url($url, PHP_URL_HOST);

        $this->urlRepository->save($shortUrl, $url, $domain);

        return $shortUrl;
    }

    private function checkUniqueness(string $shortUrl): bool
    {
        $duplicates = $this->getDuplicatesFromDb($shortUrl);

        foreach ($duplicates as $duplicate) {
            if ($shortUrl === $duplicate) {
                return false;
            }
        }

        return true;
    }

    private function getDuplicatesFromDb(string $shortUrl): ?Collection
    {
        return $this->urlRepository->getAllByShortUrl($shortUrl);
    }

    public function getRedirectUrl(string $shortUrl): string
    {
        $urls = $this->getDuplicatesFromDb($shortUrl);

        foreach ($urls as $url) {
            if ($url->short_key === $shortUrl) {
                return $url->url;
            }
        }
    }
}
