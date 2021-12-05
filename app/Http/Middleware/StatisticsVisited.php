<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\IStatisticRepository;
use App\Services\Statistics\StatisticDataTransformer;
use Closure;
use Illuminate\Http\Request;
use App;

class StatisticsVisited
{
    private const VISITED = 'short_url_visited';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $statisticRepository = App::make(IStatisticRepository::class);
        $dto = (new StatisticDataTransformer())->fromRequest($request, self::VISITED);

        $statisticRepository->save($dto);

        return $next($request);
    }
}
