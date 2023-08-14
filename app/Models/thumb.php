<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\thumb
 *
 * @property int $id
 * @property string $thumbable_type
 * @property int $thumbable_id
 * @property int|null $user_id
 * @property int|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $thumbable
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $user_pub
 * @method static \Illuminate\Database\Eloquent\Builder|thumb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|thumb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|thumb query()
 * @method static \Illuminate\Database\Eloquent\Builder|thumb whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|thumb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|thumb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|thumb whereThumbableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|thumb whereThumbableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|thumb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|thumb whereUserId($value)
 * @mixin \Eloquent
 */
class thumb extends Model
{
    use HasFactory, InteractsWithUser;
    protected $fillable = ['content'];

    public function thumbable()
    {
        return $this->morphTo();
    }
}
