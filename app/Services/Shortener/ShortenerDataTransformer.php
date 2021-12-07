<?php

namespace App\Services\Shortener;

use App\Http\Requests\UrlShortenerRequest;
use Auth;

final class ShortenerDataTransformer
{
    public function fromRequest(UrlShortenerRequest $request)
    {
        $data = [
            'url' => $request->input('url'),
            'name' => $request->input('name'),
            'domain' => $this->parseDomain($request->input('url')),
            'userId' => Auth::id(),
            'isSecret' => $request->has('isSecret'),
            'isNamed' => $this->isNamed($request->has('isSecret'), $request->filled('name')),
            'isGenerated' => $this->isGenerated($request->has('isSecret'), $request->filled('name')),
        ];

        return new ShortenerDto($data);
    }

    private function parseDomain(string $url): string
    {
        return parse_url($url, PHP_URL_HOST);
    }

    private function isNamed(bool $isSecret, bool $hasName): bool
    {
        return !$isSecret && $hasName;
    }

    private function isGenerated(bool $isSecret, bool $hasName): bool
    {
        return !$isSecret && !$hasName;
    }
}
