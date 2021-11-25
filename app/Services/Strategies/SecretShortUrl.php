<?php

namespace App\Services\Strategies;

use App\Repositories\Contracts\IUrlRepository;
use App\Services\Contracts\IShortenerStrategy;
use App\Services\Contracts\IShortUrlGenerator;
use App\Services\ShortenerDto;

class SecretShortUrl implements IShortenerStrategy
{
    private ShortenerDto $shortenerData;
    private IUrlRepository $urlRepository;
    private IShortUrlGenerator $generator;
    public string $message = '';
    private const ERROR_MESSAGE = 'Name already exists!';

    public function __construct(ShortenerDto $dto, IUrlRepository $repository, IShortUrlGenerator $generator)
    {
        $this->shortenerData = $dto;
        $this->urlRepository = $repository;
        $this->generator = $generator;
    }

    public function create(): string
    {
        $shortKey = $this->generateShortKey();
        $secretKey = $this->generateSecretKey();

        if ($this->isUnique($shortKey)) {
            return $this->urlRepository->save($this->shortenerData, $shortKey, $secretKey);
        }

        return '';
    }

    private function isUnique(string $shortKey): bool
    {
        if ($this->urlRepository->getUrlByShortKey($shortKey)) {
            return false;
        }
        return true;
    }

    private function generateShortKey(): string
    {
        return $this->generator->generate();
    }

    private function generateSecretKey(): string
    {
        return $this->generator->generate();
    }
}
