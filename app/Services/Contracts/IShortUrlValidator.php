<?php

namespace App\Services\Contracts;

use App\Repositories\Contracts\IUrlRepository;

interface IShortUrlValidator
{
    public function validate(string $shortUrl): bool;
}
