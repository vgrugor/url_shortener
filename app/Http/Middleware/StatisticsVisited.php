<?php

namespace App\Http\Middleware;

use App\Services\StatisticsService;
use Closure;
use Illuminate\Http\Request;

class StatisticsVisited
{
    private StatisticsService $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $this->statisticsService->writeVisited($request);

        return $next($request);
    }
}
