<?php

namespace App\Services\Shortener\Strategies;

use App\Services\Shortener\ShortenerDto;
use App\Services\Shortener\ShortUrlGenerator;

final class SecretShortUrl extends BaseStrategy
{
    public function create(ShortenerDto $dto): string
    {
        $shortKey = $this->generateShortKey();
        $secretKey = $this->generateSecretKey();

        if ($this->isUnique($shortKey)) {
            return $this->urlRepository->save($dto, $shortKey, $secretKey);
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
        return $this->generator->generate(ShortUrlGenerator::MIN_LENGTH_SECRET_KEY, ShortUrlGenerator::MAX_LENGTH_SECRET_KEY);
    }
}
