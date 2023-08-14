<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\score
 *
 * @property int $id
 * @property string $scoreable_type
 * @property int $scoreable_id
 * @property int|null $user_id
 * @property int|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $scoreable
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $user_pub
 * @method static \Illuminate\Database\Eloquent\Builder|score newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|score newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|score query()
 * @method static \Illuminate\Database\Eloquent\Builder|score whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|score whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|score whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|score whereScoreableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|score whereScoreableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|score whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|score whereUserId($value)
 * @mixin \Eloquent
 */
class score extends Model
{
    use HasFactory, InteractsWithUser;
    protected $fillable = ['content'];

    public function scoreable()
    {
        return $this->morphTo();
    }
}
