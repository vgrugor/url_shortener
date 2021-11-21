<?php

namespace App\Services;

use App\Services\Contracts\IShortUrlValidator;
use App\Services\Contracts\IShortUrlGenerator;
use Exception;
use Illuminate\Support\Str;

class ShortUrlGeneratorService implements IShortUrlGenerator
{
    private IShortUrlValidator $validator;

    public function __construct(IShortUrlValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function getShortUrl(): string
    {
        do {
            $shortUrl = Str::random(random_int(1, 10));
        } while(!$this->validator->validate($shortUrl));

        return $shortUrl;
    }
}
