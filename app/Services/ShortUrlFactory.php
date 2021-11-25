<?php

namespace App\Services;

use App\Services\Contracts\IShortenerStrategy;
use App\Services\Strategies\NamedShortUrl;
use Illuminate\Container\Container;

final class ShortUrlFactory
{
    private ShortenerDto $shortenerDto;

    public function __construct(ShortenerDto $shortenerDto)
    {
        $this->shortenerDto = $shortenerDto;
    }

    //TODO: return type
    public function getShortenerStrategy(): IShortenerStrategy
    {
        $container = Container::getInstance();

        if (!is_null($this->shortenerDto->name)) {
            return $container->make(NamedShortUrl::class);
        }
        /*elseif ($dto->isSecret) {
            return new SecretShortUrl($dto);
    } else {
            return new SimpleShortUrl($dto);
    }*/
    }
}
