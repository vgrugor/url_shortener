<?php

namespace App\Repositories\Contracts;

use App\Models\Url;
use App\Services\Shortener\ShortenerDto;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

interface IUrlRepository
{
    public const IS_NAMED = 1 << 0;
    public const IS_SECRET = 1 << 1;
    public const POPULAR_LIMIT = 10;
    public const COUNT_URLS_ONE_PAGE = 20;

    public function save(ShortenerDto $dto, string $shortKey, string $secretKey = null): string;

    public function getUrlByShortKey(string $shortKey): ?Url;

    public function getSecretUrlByShortKey(string $shortKey, string $secretKey): ?Url;

    public function setAttributes(ShortenerDto $dto): int;

    public function getPopularUrlByUser(int $id): ?Collection;

    public function getAll(): ?Paginator;
}
