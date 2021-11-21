<?php

namespace App\Services;

use App\Services\Contracts\IShortUrlGenerator;
use Exception;
use Illuminate\Support\Str;

class ShortUrlGeneratorService implements IShortUrlGenerator
{
    private const MIN_LEN_KEY = 1;
    private const MAX_LEN_KEY = 10;

    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function generate(): string
    {
        return Str::random(random_int(self::MIN_LEN_KEY, self::MAX_LEN_KEY));
    }
}
