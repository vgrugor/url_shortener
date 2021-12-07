<?php

namespace App\Repositories;

use App\Models\Url;
use App\Repositories\Contracts\IUrlRepository;
use App\Services\Shortener\ShortenerDto;
use Illuminate\Database\Eloquent\Collection;

class UrlRepository implements IUrlRepository
{
    private Url $url;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    public function save(ShortenerDto $shortenerDto, string $shortKey, string $secretKey = null): string
    {
        $newUrl = new $this->url();

        $newUrl->user_id = $shortenerDto->userId;
        $newUrl->short_key = $shortKey;
        $newUrl->secret_key = $secretKey;
        $newUrl->attributes = $this->setAttributes($shortenerDto);
        $newUrl->url = $shortenerDto->url;
        $newUrl->domain = $shortenerDto->domain;

        $newUrl->save();

        return $secretKey ? $shortKey . '/' . $secretKey: $shortKey;
    }

    public function getUrlByShortKey(string $shortKey): ?Url
    {
        $conditions = [
            ['short_key', '=', $shortKey],
            ['valid_at', '>=', now()],
        ];

        return Url::where($conditions)->first();
    }

    public function getSecretUrlByShortKey(string $shortKey, string $secretKey): ?Url
    {
        $conditions = [
            ['short_key', '=', $shortKey],
            ['secret_key', '=', $secretKey],
            ['valid_at', '>=', now()],
        ];

        return Url::where($conditions)->first();
    }

    public function setAttributes(ShortenerDto $shortenerDto): int
    {
        $attributes = 0;

        if ($shortenerDto->name !== null) {
            $attributes |= self::IS_NAMED;
        }

        if ($shortenerDto->isSecret === true) {
            $attributes |= self::IS_SECRET;
        }

        return $attributes;
    }

    public function getPopularUrlByUser(int $id): ?Collection
    {
        return Url::with('Statistics')
            ->withCount('Statistics')
            ->orderBy('statistics_count', 'DESC')
            ->limit(self::POPULAR_LIMIT)
            ->get();
    }
}
