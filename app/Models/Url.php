<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 */
class Url extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
}
