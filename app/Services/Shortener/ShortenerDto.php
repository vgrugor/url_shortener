<?php

namespace App\Services\Shortener;

use App\Http\Requests\UrlShortenerRequest;
use Illuminate\Support\Facades\Auth;

final class ShortenerDto
{
    public string $url;
    public ?string $name;
    public bool $isSecret;
    public string $domain;
    public int $userId;

    public function __construct(UrlShortenerRequest $request)
    {
        $this->url = $request->input('url');
        $this->name = $request->input('name');
        $this->isSecret= $request->input('isSecret') ?? false;
        $this->domain = parse_url($request->input('url'), PHP_URL_HOST);
        $this->userId = Auth::id();
    }
}
