<?php

namespace App\Repositories\Contracts;


use App\Services\Statistics\StatisticDto;

interface IStatisticRepository
{
    public function save(StatisticDto $statisticsDto): void;
}
