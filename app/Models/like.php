<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\like
 *
 * @property int $id
 * @property string $likeable_type
 * @property int $likeable_id
 * @property int|null $user_id
 * @property int|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $likeable
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $user_pub
 * @method static \Illuminate\Database\Eloquent\Builder|like newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|like newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|like query()
 * @method static \Illuminate\Database\Eloquent\Builder|like whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|like whereLikeableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|like whereLikeableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|like whereUserId($value)
 * @mixin \Eloquent
 */
class like extends Model
{
    use HasFactory, InteractsWithUser;
    protected $fillable = ['content'];

    public function likeable()
    {
        return $this->morphTo();
    }
}
