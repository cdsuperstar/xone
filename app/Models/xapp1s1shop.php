<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\xapp1s1shop
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class xapp1s1shop extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, InteractsWithUser;

    protected $fillable = [
        'name', 'starttime', 'endtime', 'status', 'phone', 'tel', 'addr', 'longitude', 'latitude', 'approval'
    ];

    protected $appends = ["avatar", "products", "environments", "menus", "qualifications", "others"];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('shopAvatar')
            ->singleFile();

//        $this->addMediaCollection('products')
//            ->addMediaCollection('environments')
//            ->addMediaCollection('menus')
//            ->addMediaCollection('qualifications')
//            ->addMediaCollection('others');
    }

    public function products()
    {
        return $this->hasMany('App\Models\xapp1s1product');
    }

    public function activates()
    {
        return $this->hasMany('App\Models\xapp1s1activate');
    }

//"shopAvatar", "products", "environments", "menus", "qualifications", "others"];
    public function getAvatarAttribute(): string
    {
        if (count($this->getMedia('shopAvatar')) > 0) {
            return $this->getMedia('shopAvatar')[0]->getFullUrl();
        } else {
            return '/assets/default_shop_avatar.jpg';
        }
    }

    public function getProductsAttribute(): string
    {
        $aRet = [];
        $oMedias = $this->getMedia('products');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return json_encode($aRet);
    }

    public function getEnvironmentsAttribute(): string
    {
        $aRet = [];
        $oMedias = $this->getMedia('environments');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return json_encode($aRet);
    }

    public function getMenusAttribute(): string
    {
        $aRet = [];
        $oMedias = $this->getMedia('menus');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return json_encode($aRet);
    }

    public function getQualificationsAttribute(): string
    {
        $aRet = [];
        $oMedias = $this->getMedia('qualifications');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return json_encode($aRet);
    }

    public function getOthersAttribute(): string
    {
        $aRet = [];
        $oMedias = $this->getMedia('others');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return json_encode($aRet);
    }

}
