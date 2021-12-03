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
        $this->eventValue = $request->path();
        $this->metadata = $this->setMetadata($request);
    }

    private function setMetadata(Request $request)
    {
        return $this->metadata = sprintf(
            self::MASK_METADATA,
            $request->ip(),
            $request->userAgent()
        );
    }
}
