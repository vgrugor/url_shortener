<?php

namespace App\Services\Strategies;

final class SecretShortUrl extends BaseStrategy
{
    public function create(): string
    {
        $shortKey = $this->generateShortKey();
        $secretKey = $this->generateSecretKey();

        if ($this->isUnique($shortKey)) {
            return $this->urlRepository->save($this->shortenerData, $shortKey, $secretKey);
        }

        return '';
    }

    private function isUnique(string $shortKey): bool
    {
        if ($this->urlRepository->getUrlByShortKey($shortKey)) {
            return false;
        }
        return true;
    }

    private function generateShortKey(): string
    {
        return $this->generator->generate();
    }

    private function generateSecretKey(): string
    {
        return $this->generator->generate();
    }
}
