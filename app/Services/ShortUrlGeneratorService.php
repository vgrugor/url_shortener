<?php

namespace App\Services;

use App\Services\Contracts\IUrlShortener;
use Illuminate\Support\Str;

class ShortUrlGeneratorService implements IUrlShortener
{

    /**
     * @param string $url
     * @return string
     * @throws \Exception
     */
    public function getShortUrl(string $url)
    {
        //do {
            $shortUrl = Str::random(random_int(1, 10));
            //TODO: перевірка чи є в базі
        //} while(поки є в БД);

        return $shortUrl;
    }
}
