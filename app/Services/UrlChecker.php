<?php

namespace App\Services;

use App\Repositories\Contracts\IUrlRepository;

final class UrlChecker
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function check(string $path): bool
    {
        if (count(explode('/', $path)) > 1) {
            $result = $this->checkSecretUrl($path);
        } else {
            $result = $this->checkNamedOrGeneratedUrl($path);
        }

        return $result;
    }

    private function checkSecretUrl(string $path): bool
    {
        [$shortKey, $secretKey] = explode('/', $path);

        $url = $this->urlRepository->getSecretUrlByShortKey($shortKey, $secretKey);

        return $url !== null;
    }

    private function checkNamedOrGeneratedUrl(string $shortKey): bool
    {
        $url = $this->urlRepository->getUrlByShortKey($shortKey);

        return $url !== null && $url->secret_key === null;
    }
}
