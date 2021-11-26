<?php

namespace App\Services;

use App\Services\Contracts\IShortenerStrategy;
use App\Services\Strategies\NamedShortUrl;
use App\Services\Strategies\SecretShortUrl;
use App\Services\Strategies\SimpleShortUrl;
use Illuminate\Container\Container;

final class ShortUrlFactory
{
    private ShortenerDto $shortenerDto;

    public function __construct(ShortenerDto $shortenerDto)
    {
        $this->shortenerDto = $shortenerDto;
    }

    public function getShortenerStrategy(): IShortenerStrategy
    {
        $container = Container::getInstance();

        if (!is_null($this->shortenerDto->name)) {
            return $container->make(NamedShortUrl::class);
        } elseif ($this->shortenerDto->isSecret) {
            return $container->make(SecretShortUrl::class);
        } else {
            return $container->make(SimpleShortUrl::class);
        }
    }
}
