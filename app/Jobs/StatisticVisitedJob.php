<?php

namespace App\Jobs;

use App;
use App\Repositories\Contracts\IStatisticRepository;
use App\Services\Statistics\StatisticDto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StatisticVisitedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public StatisticDto $dto;

    public function __construct(StatisticDto $dto)
    {
        $this->dto = $dto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(IStatisticRepository $statisticRepository)
    {
        $statisticRepository->save($this->dto);
    }
}
