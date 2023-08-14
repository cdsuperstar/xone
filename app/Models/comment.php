<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\comment
 *
 * @property int $id
 * @property string $commentable_type
 * @property int $commentable_id
 * @property int|null $user_id
 * @property string|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $commentable
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $user_pub
 * @method static \Illuminate\Database\Eloquent\Builder|comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|comment whereUserId($value)
 * @mixin \Eloquent
 */
class comment extends Model
{
    use HasFactory, InteractsWithUser;
    protected $fillable = ['content'];

    public function commentable()
    {
        return $this->morphTo();
    }

}
