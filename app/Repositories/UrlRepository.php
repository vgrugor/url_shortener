<?php

namespace App\Repositories;

use App\Models\Url;

class UrlRepository implements Contracts\IUrlRepository
{

    public function add(string $shortUrl, string $url, string $domain): void
    {
        $newUrl = new Url();

        $newUrl->short_key = $shortUrl;
        $newUrl->url = $url;
        $newUrl->domain = $domain;

        $newUrl->save();
    }
}
