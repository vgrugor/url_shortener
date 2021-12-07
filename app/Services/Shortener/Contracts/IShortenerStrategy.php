<?php

namespace App\Services\Shortener\Contracts;

use App\Services\Shortener\ShortenerDto;

interface IShortenerStrategy
{
    public function create(ShortenerDto $dto);
}
