<?php

namespace App\Repositories;

use App\Models\Statistic;

class StatisticRepository implements Contracts\IStatisticRepository
{
    public function save($a): void
    {
        $statistics = new Statistic();

        $statistics->user_id = $a['user_id'];
        $statistics->event_type = $a['event_type'];
        $statistics->event_value = $a['event_value'];
        $statistics->metadata = $a['metadata'];

        $statistics->save();
        // TODO: Implement save() method.
    }
}
