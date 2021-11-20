<?php

namespace App\Repositories\Contracts;

interface IUrlRepository
{
    public function add(string $shortUrl, string $url, string $domain): void;
}
