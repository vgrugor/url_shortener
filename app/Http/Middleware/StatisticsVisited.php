<?php

namespace App\Http\Middleware;

use App\Jobs\StatisticVisitedJob;
use App\Repositories\Contracts\IStatisticRepository;
use App\Repositories\StatisticRepository;
use App\Services\Statistics\StatisticDataTransformer;
use Closure;
use Illuminate\Http\Request;
use App;

class StatisticsVisited
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $dto = (new StatisticDataTransformer())->fromRequest($request, StatisticRepository::VISITED);

        StatisticVisitedJob::dispatch($dto);

        return $next($request);
    }
}
