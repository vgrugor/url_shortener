<?php

namespace App\Services\Shortener\Strategies;

use App\Services\Shortener\ShortenerDto;

final class NamedShortUrl extends BaseStrategy
{
    public function create(ShortenerDto $dto): string
    {
        if ($this->isUnique($dto->getName())) {
            return $this->urlRepository->save($dto, $dto->getName());
        }

        return '';
    }

    private function isUnique(string $name): bool
    {
        if ($this->urlRepository->getUrlByShortKey($name)) {
            return false;
        }
        return true;
    }
}
