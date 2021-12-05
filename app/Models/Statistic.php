<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Statistic
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $event_type
 * @property string|null $event_value
 * @property string $metadata
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereEventType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereEventValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereUserId($value)
 * @mixin \Eloquent
 */
class Statistic extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
}
