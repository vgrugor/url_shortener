<?php

namespace App\Services\Statistics;

class StatisticDto
{
    private ?int $userId;
    private string $eventType;
    private string $eventValue;
    private string $metadata;

    public function __construct(array $data)
    {
        $this->userId = $data['userId'];
        $this->eventType = $data['eventType'];
        $this->eventValue = $data['eventValue'];
        $this->metadata = $data['metadata'];
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function getEventValue(): string
    {
        return $this->eventValue;
    }

    public function getMetadata(): string
    {
        return $this->metadata;
    }
}
