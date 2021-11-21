<?php

namespace App\Services\Contracts;

interface IShortUrlGenerator
{
    public function getShortUrl(): string;
}
