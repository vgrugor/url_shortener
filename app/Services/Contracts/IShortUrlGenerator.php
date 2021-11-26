<?php

namespace App\Services\Contracts;

interface IShortUrlGenerator
{
    public function generate(): string;
}
