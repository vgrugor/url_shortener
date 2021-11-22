<?php

namespace App\Repositories;

use App\Models\Url;

class UrlRepository implements Contracts\IUrlRepository
{
    private Url $url;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    public function save(int $userId, string $shortUrl, string $url, string $domain): Url
    {
        $newUrl = new $this->url();
        $newUrl->user_id = $userId;
        $newUrl->short_key = $shortUrl;
        $newUrl->url = $url;
        $newUrl->domain = $domain;
        $newUrl->save();

        return $newUrl;
    }

    public function getUrlByShortKey(string $shortUrl): ?Url
    {
        return Url::where('short_key', $shortUrl)->first();
    }
}
