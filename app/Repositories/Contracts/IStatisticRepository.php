<?php

namespace App\Repositories\Contracts;


use App\Services\Statistics\StatisticDto;

interface IStatisticRepository
{
    public const VISITED = 'short_url_visited';
    public const CREATED = 'short_url_create';

    public function save(StatisticDto $statisticsDto): void;
}
