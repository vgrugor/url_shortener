<?php

namespace App\Services\Shortener\Strategies;

use App\Services\Shortener\ShortenerDto;

final class GeneratedShortUrl extends BaseStrategy
{
    public function create(ShortenerDto $dto): string
    {
        $shortKey = $this->generateShortKey();

        if ($this->isUnique($shortKey)) {
            return $this->urlRepository->save($dto, $shortKey);
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
}
