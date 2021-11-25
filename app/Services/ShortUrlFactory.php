<?php

namespace App\Services;

use App\Services\Strategies\NamedShortUrl;
use Illuminate\Container\Container;

final class ShortUrlFactory
{
    private ShortenerDto $shortenerData;

    public function __construct(ShortenerDto $shortenerData)
    {
        $this->shortenerData = $shortenerData;
    }

    //TODO: return type
    public function getShortenerStrategy()
    {
        $container = Container::getInstance();

        if (!is_null($this->shortenerData->name)) {
            return $container->make(NamedShortUrl::class);
        }
        /*elseif ($dto->isSecret) {
            return new SecretShortUrl($dto);
    } else {
            return new SimpleShortUrl($dto);
    }*/
    }
}
