<?php

namespace App\Repositories\Contracts;

use App\Models\Url;
use Illuminate\Database\Eloquent\Collection;

interface IUrlRepository
{
    public function save(int $userId, string $shortUrl, string $url, string $domain): Url;

    public function getUrlByShortKey(string $shortUrl): ?Url;
}
