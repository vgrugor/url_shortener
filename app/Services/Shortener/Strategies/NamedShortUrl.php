<?php

namespace App\Services\Shortener\Strategies;

final class NamedShortUrl extends BaseStrategy
{
    public function create(): string
    {
        if ($this->isUnique()) {
            return $this->urlRepository->save($this->shortenerData, $this->shortenerData->name);
        }

        return '';
    }

    private function isUnique(): bool
    {
        if ($this->urlRepository->getUrlByShortKey($this->shortenerData->name)) {
            return false;
        }
        return true;
    }
}
