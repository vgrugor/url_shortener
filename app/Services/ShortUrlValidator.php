<?php

namespace App\Services;

use App\Repositories\Contracts\IUrlRepository;
use App\Services\Contracts\IShortUrlValidator;

class ShortUrlValidator implements IShortUrlValidator
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function validate(string $shortUrl): bool
    {
        $shortUrlsFromDb = $this->urlRepository->getAllByShortUrl($shortUrl);

        foreach ($shortUrlsFromDb as $shortUrlFromDb) {
            if ($shortUrl === $shortUrlFromDb) {
                return false;
            }
        }

        return true;
    }
}
