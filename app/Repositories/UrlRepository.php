<?php

namespace App\Repositories;

use App\Models\Url;
use App\Services\ShortenerDto;

class UrlRepository implements Contracts\IUrlRepository
{
    private Url $url;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    public function save(ShortenerDto $shortenerDto, string $shortKey): string
    {
        $newUrl = new $this->url();

        $newUrl->user_id = $shortenerDto->userId;
        $newUrl->short_key = $shortKey;
        $newUrl->url = $shortenerDto->url;
        $newUrl->domain = $shortenerDto->domain;

        $newUrl->save();

        return $shortKey;
    }

    public function getUrlByShortKey(string $shortUrl): ?Url
    {
        return Url::where('short_key', $shortUrl)->first();
    }
}
