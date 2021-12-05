<?php

namespace App\Repositories;

use App\Models\Statistic;
use App\Services\Statistics\StatisticDto;

class StatisticRepository implements Contracts\IStatisticRepository
{
    public function save(StatisticDto $statisticsDto): void
    {
        $statistics = new Statistic();

        $statistics->user_id = $statisticsDto->getUserId();
        $statistics->event_type = $statisticsDto->getEventType();
        $statistics->event_value = $statisticsDto->getEventValue();
        $statistics->metadata = $statisticsDto->getMetadata();

        $statistics->save();
    }
}
