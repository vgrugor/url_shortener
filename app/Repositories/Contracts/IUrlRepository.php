<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface IUrlRepository
{
    public function add(string $shortUrl, string $url, string $domain): void;

    public function getAllByShortUrl(string $shortUrl): ?Collection;
}
