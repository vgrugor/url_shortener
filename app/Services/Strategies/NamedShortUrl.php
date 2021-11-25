<?php

namespace App\Services\Strategies;

use App\Repositories\Contracts\IUrlRepository;
use App\Services\Contracts\IShortenerStrategy;
use App\Services\ShortenerDto;

class NamedShortUrl implements IShortenerStrategy
{
    private ShortenerDto $shortenerData;
    private IUrlRepository $urlRepository;

    public function __construct(ShortenerDto $dto, IUrlRepository $repository)
    {
        $this->shortenerData = $dto;
        $this->urlRepository = $repository;
    }

    public function create(): void
    {
        if ($this->isUnique()) {
            $this->urlRepository->save($this->shortenerData, $this->shortenerData->name);
        }
    }

    private function isUnique(): bool
    {
        if ($this->urlRepository->getUrlByShortKey($this->shortenerData->name)) {
            return false;
        }
        return true;
    }
}
