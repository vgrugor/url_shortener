<?php

namespace App\Services;

use App\Services\Contracts\IShortUrlGenerator;
use Exception;
use Illuminate\Support\Str;

class ShortUrlGeneratorService implements IShortUrlGenerator
{
    public const MIN_LEN_SHORT_KEY = 1;
    public const MAX_LEN_SHORT_KEY = 10;
    public const MIN_LENGTH_SECRET_KEY = 5;
    public const MAX_LENGTH_SECRET_KEY = 10;

    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function generate(int $min = self::MIN_LEN_SHORT_KEY, int $max = self::MAX_LEN_SHORT_KEY): string
    {
        return Str::random(random_int($min, $max));
    }
}
