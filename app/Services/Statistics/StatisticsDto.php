<?php

namespace App\Services\Statistics;

use Auth;
use Illuminate\Http\Request;

class StatisticsDto
{
    public ?int $userId;
    public string $eventType;
    public string $eventValue;
    public string $metadata;
    private const MASK_METADATA = '{"ip": %s, "userAgent": %s}';

    public function __construct(Request $request)
    {
        $this->userId = Auth::id();
        $this->eventValue = $this->setShortUrl($request->path());
        $this->metadata = $this->setMetadata($request);
    }

    private function setMetadata(Request $request): string
    {
        return $this->metadata = sprintf(
            self::MASK_METADATA,
            $request->ip(),
            $request->userAgent()
        );
    }

    private function setShortUrl(string $path): string
    {
        if (count(explode('/', $path)) > 1) {
            $path = explode('/', $path)[0];
        }

        return $path;
    }
}
