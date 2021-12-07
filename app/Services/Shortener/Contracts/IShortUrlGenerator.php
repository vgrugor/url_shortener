<?php

namespace App\Services\Shortener\Contracts;

interface IShortUrlGenerator
{
    public function generate(): string;
}
