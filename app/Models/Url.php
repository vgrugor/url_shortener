<?php

namespace App\Models;

use App\Repositories\Contracts\IStatisticRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

/**
 * App\Models\Url
 *
 * @property int $id
 * @property string $short_key
 * @property string $url
 * @property string $domain
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|Url newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Url newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Url query()
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereShortKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereUrl($value)
 * @mixin \Eloquent
 * @property int|null $user_id
 * @property string $visited_at
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereVisitedAt($value)
 * @property string|null $secret_key
 * @property string $valid_at
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereValidAt($value)
 * @property int $attributes
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereAttributes($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Statistic[] $statistics
 * @property-read int|null $statistics_count
 */
class Url extends Model
{
    use HasFactory;
    use Prunable;

    const UPDATED_AT = null;

    public function prunable()
    {
        return static::where('valid_at', '<', now());
    }

    protected function pruning()
    {
        Statistic::with('url')
            ->whereHas('url', function ($q) {
                $q->where('valid_at', '<', now());
            })->delete();
    }

    public function statisticsVisited()
    {
        return $this->hasMany(Statistic::class, 'event_value', 'short_key')
            ->where('event_type', IStatisticRepository::VISITED);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
