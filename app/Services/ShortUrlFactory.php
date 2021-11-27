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

    /**
     * @return IShortenerStrategy
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getShortenerStrategy(): IShortenerStrategy
    {
        $container = Container::getInstance();

        if (!is_null($this->shortenerDto->name)) {
            return $container->make(NamedShortUrl::class);
        }

        if ($this->shortenerDto->isSecret) {
            return $container->make(SecretShortUrl::class);
        }

        return $container->make(SimpleShortUrl::class);
    }
}
