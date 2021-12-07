<?php

namespace App\Services\Shortener\Strategies;

use App\Repositories\Contracts\IUrlRepository;
use App\Services\Shortener\Contracts\IShortenerStrategy;
use App\Services\Shortener\Contracts\IShortUrlGenerator;
use App\Services\Shortener\ShortenerDto;

abstract class BaseStrategy implements IShortenerStrategy
{
    protected ShortenerDto $shortenerData;
    protected IUrlRepository $urlRepository;
    protected IShortUrlGenerator $generator;

    public function __construct(ShortenerDto $dto, IUrlRepository $repository, IShortUrlGenerator $generator)
    {
        $this->shortenerData = $dto;
        $this->urlRepository = $repository;
        $this->generator = $generator;
    }

    abstract public function create();
}
