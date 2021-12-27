<?php

namespace App\Services\Shortener;

use App\Services\Shortener\Contracts\IShortenerStrategy;
use App\Services\Shortener\Strategies\NamedShortUrl;
use App\Services\Shortener\Strategies\SecretShortUrl;
use App\Services\Shortener\Strategies\GeneratedShortUrl;
use App;

final class ShortUrlFactory
{
    /**
     * @param ShortenerDto $dto
     * @return IShortenerStrategy
     */
    public function getShortenerStrategy(ShortenerDto $dto): IShortenerStrategy
    {
        if ($dto->getIsNamed()) {
            return App::make(NamedShortUrl::class);
        }

        if ($dto->getIsSecret()) {
            return App::make(SecretShortUrl::class);
        }

        return App::make(GeneratedShortUrl::class);
    }
}
