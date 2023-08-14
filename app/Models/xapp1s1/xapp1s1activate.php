<?php

namespace App\Models\xapp1s1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\xapp1s1\xapp1s1activate
 *
 * @property int $id
 * @property int|null $xapp1s1shop_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $tagprice
 * @property string|null $price
 * @property string|null $timebegin
 * @property string|null $timeend
 * @property string|null $address
 * @property int|null $slot
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $pics
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\xapp1s1\xapp1s1shop|null $shop
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\xapp1s1\xapp1s1slot[] $slots
 * @property-read int|null $slots_count
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate query()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereTagprice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereTimebegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereTimeend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1activate whereXapp1s1shopId($value)
 * @mixin \Eloquent
 */
class xapp1s1activate extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['xapp1s1shop_id', 'name', 'description', 'tagprice', 'price', 'timebegin', 'timeend', 'address', 'slot'];
    protected $appends = ['pics'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('pics');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\xapp1s1\xapp1s1shop', 'xapp1s1shop_id');
    }

    public function slots()
    {
        return $this->hasMany('App\Models\xapp1s1\xapp1s1slot');
    }

    public function getPicsAttribute(): array
    {
        $aRet = [];
        $oMedias = $this->getMedia('pics');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return $aRet;
    }
}
