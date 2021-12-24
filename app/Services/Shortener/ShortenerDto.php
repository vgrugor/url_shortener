<?php

namespace App\Services\Shortener;

use Carbon\Carbon;

final class ShortenerDto
{
    private string $url;
    private ?string $name;
    private Carbon $validAt;
    private string $domain;
    private int $userId;
    private bool $isSecret;
    private bool $isNamed;
    private bool $isGenerated;

    public function __construct(array $data)
    {
        $this->url = $data['url'];
        $this->name = $data['name'];
        $this->isSecret = $data['isSecret'];
        $this->validAt = $data['validAt'];
        $this->domain = $data['domain'];
        $this->userId = $data['userId'];
        $this->isNamed = $data['isNamed'];
        $this->isGenerated = $data['isGenerated'];
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getIsSecret(): bool
    {
        return $this->isSecret;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getIsNamed(): bool
    {
        return $this->isNamed;
    }

    public function getIsGenerated(): bool
    {
        return $this->isGenerated;
    }

    public function getValidAt(): Carbon
    {
        return $this->validAt;
    }
}
