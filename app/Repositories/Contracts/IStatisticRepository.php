<?php

namespace App\Repositories\Contracts;

use App\Services\Statistics\StatisticsDto;

interface IStatisticRepository
{
    public function save(StatisticsDto $statisticsDto): void;
}
