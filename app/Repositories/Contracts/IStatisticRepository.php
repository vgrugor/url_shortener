<?php

namespace App\Repositories\Contracts;

use App\Services\Statistics\StatisticDto;
use Illuminate\Database\Eloquent\Collection;

interface IStatisticRepository
{
    public function save(StatisticDto $statisticsDto): void;
}
