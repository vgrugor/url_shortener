<?php

namespace App\Services\Strategies;

use App\Repositories\Contracts\IUrlRepository;
use App\Services\Contracts\IShortenerStrategy;
use App\Services\Contracts\IShortUrlGenerator;
use App\Services\ShortenerDto;

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
