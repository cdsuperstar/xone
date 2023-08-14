<?php

namespace App\Models\xapp1s1;

use App\Traits\InteractsWithComment;
use App\Traits\InteractsWithThumb;
use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\xapp1s1\xapp1s1moment
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $note
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\comment|null $comment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\thumb[] $thumbs
 * @property-read int|null $thumbs_count
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $user_pub
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1moment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1moment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1moment query()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1moment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1moment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1moment whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1moment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1moment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1moment whereUserId($value)
 * @mixin \Eloquent
 */
class xapp1s1moment extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, InteractsWithComment, Interactswiththumb, InteractsWithUser;
    protected $fillable = ['note','type'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('pics');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
//        return $date->toW3cString();
    }
}
