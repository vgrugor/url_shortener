<?php

namespace App\Services;

use App\Repositories\Contracts\IStatisticRepository;
use Illuminate\Http\Request;

final class StatisticsService
{
    private const CREATE = 'short_url_create';
    private const VISITED = 'short_url_visited';
    private IStatisticRepository $statisticRepository;

    public function __construct(IStatisticRepository $statisticRepository)
    {
        $this->statisticRepository = $statisticRepository;
    }

    public function writeCreate()
    {
        //TODO: add code

        $this->statisticRepository->save();
    }

    public function writeVisited(Request $request)
    {
        $a = [
            'user_id' => \Auth::id(),
            'event_type' => self::VISITED,
            'event_value' => $request->url(),
            'metadata' => 'asdsadasdasda',
        ];

        $this->statisticRepository->save($a);
    }
}
