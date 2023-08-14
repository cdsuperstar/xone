<?php

namespace App\Models\xapp1s1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\xapp1s1\xapp1s1product
 *
 * @property int $id
 * @property string $name
 * @property string|null $tagprice
 * @property string|null $price
 * @property string|null $timebegin
 * @property string|null $timeend
 * @property string|null $note
 * @property int|null $xapp1s1shop_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $productimgs
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\xapp1s1\xapp1s1shop|null $shop
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product query()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product whereTagprice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product whereTimebegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product whereTimeend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1product whereXapp1s1shopId($value)
 * @mixin \Eloquent
 */
class xapp1s1product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 'tagprice', 'price', 'note', 'timebegin', 'timeend'
    ];
    protected $appends = ["productimgs"];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('productimgs');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\xapp1s1\xapp1s1shop');
    }

    public function getProductimgsAttribute(): array
    {
        $aRet = [];
        $oMedias = $this->getMedia('productimgs');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return $aRet;
    }

}
