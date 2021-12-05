<?php

namespace App\Services\Statistics;

use Illuminate\Http\Request;
use Auth;

class StatisticDataTransformer
{
    private const MASK_METADATA = '{"ip": %s, "userAgent": %s}';

    public function fromRequest(Request $request, string $eventType): StatisticDto
    {
        $data = [
            'userId' => Auth::id(),
            'eventType' => $eventType,
            'eventValue' => $this->setShortUrl($request->path()),
            'metadata' => $this->setMetadata($request),
        ];

        return new StatisticDto($data);
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
