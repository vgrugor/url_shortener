<?php

namespace App\Repositories\Contracts;

use App\Models\Url;
use App\Services\ShortenerDto;
use Illuminate\Database\Eloquent\Collection;

interface IUrlRepository
{
    public function save(ShortenerDto $dto, string $shortKey): string;

    public function getUrlByShortKey(string $shortUrl): ?Url;
}
