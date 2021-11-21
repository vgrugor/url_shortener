<?php

namespace App\Repositories;

use App\Models\Url;
use Illuminate\Database\Eloquent\Collection;

class UrlRepository implements Contracts\IUrlRepository
{
    private Url $url;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    public function save(string $shortUrl, string $url, string $domain): Url
    {
        $newUrl = new Url();
        $newUrl->short_key = $shortUrl;
        $newUrl->url = $url;
        $newUrl->domain = $domain;
        $newUrl->save();

        return $newUrl;
    }

    public function getAllByShortUrl(string $shortUrl): ?Collection
    {
        return Url::where('short_key', $shortUrl)->get();
    }
}
