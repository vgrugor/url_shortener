<?php

namespace App\Repositories;

use App\Models\Statistic;
use App\Services\Statistics\StatisticsDto;

class StatisticRepository implements Contracts\IStatisticRepository
{
    public function save(StatisticsDto $statisticsDto): void
    {
        $statistics = new Statistic();

        $statistics->user_id = $statisticsDto->userId;
        $statistics->event_type = $statisticsDto->eventType;
        $statistics->event_value = $statisticsDto->eventValue;
        $statistics->metadata = $statisticsDto->metadata;

        $statistics->save();
    }
}
