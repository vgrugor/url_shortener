<?php

namespace App\Repositories\Contracts;

use App\Models\Url;
use App\Services\ShortenerDto;

interface IUrlRepository
{
    public function save(ShortenerDto $dto, string $shortKey, string $secretKey = null): string;

    public function getUrlByShortKey(string $shortKey): ?Url;

    public function getSecretUrlByShortKey(string $shortKey, string $secretKey): ?Url;
}
