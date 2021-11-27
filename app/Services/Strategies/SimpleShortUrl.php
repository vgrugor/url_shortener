<?php

namespace App\Services\Strategies;

final class SimpleShortUrl extends BaseStrategy
{
    public function create(): string
    {
        $shortKey = $this->generateShortKey();

        if ($this->isUnique($shortKey)) {
            return $this->urlRepository->save($this->shortenerData, $shortKey);
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
