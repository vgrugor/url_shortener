<?php

namespace App\Services;

use App\Repositories\Contracts\IStatisticRepository;
use App\Services\Statistics\StatisticsDto;

final class StatisticsService
{
    private const CREATE = 'short_url_create';
    private const VISITED = 'short_url_visited';
    private IStatisticRepository $statisticRepository;
    private StatisticsDto $statisticsDto;

    public function __construct(IStatisticRepository $statisticRepository, StatisticsDto $statisticsDto)
    {
        $this->statisticRepository = $statisticRepository;
        $this->statisticsDto = $statisticsDto;
    }

    public function writeCreate()
    {
        //TODO: add code

        $this->statisticRepository->save();
    }

    public function writeVisited(): void
    {
        $this->statisticsDto->eventType = self::VISITED;

        $this->statisticRepository->save($this->statisticsDto);
    }
}
