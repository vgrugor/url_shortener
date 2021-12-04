<?php

namespace App\Services;

use App\Models\Url;
use App\Repositories\Contracts\IUrlRepository;

final class UrlChecker
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function check(string $path): ?Url
    {
        if (count(explode('/', $path)) > 1) {
            $result = $this->checkSecretUrl($path);
        } else {
            $result = $this->checkNamedOrGeneratedUrl($path);
        }

        return $result;
    }

    private function checkSecretUrl(string $path): ?Url
    {
        [$shortKey, $secretKey] = explode('/', $path);

        return $this->urlRepository->getSecretUrlByShortKey($shortKey, $secretKey);
    }

    private function checkNamedOrGeneratedUrl(string $shortKey): ?Url
    {
        return $this->urlRepository->getUrlByShortKey($shortKey);
    }
}
