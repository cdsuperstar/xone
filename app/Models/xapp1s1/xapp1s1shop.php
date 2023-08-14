<?php

namespace App\Models\xapp1s1;

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
 * @property int $user_id
 * @property string|null $name
 * @property string|null $starttime
 * @property string|null $endtime
 * @property string|null $status
 * @property string|null $phone
 * @property string|null $tel
 * @property string|null $province
 * @property string|null $city
 * @property string|null $district
 * @property string|null $addr
 * @property float|null $longitude
 * @property float|null $latitude
 * @property string|null $approval
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\xapp1s1\xapp1s1activate[] $activates
 * @property-read int|null $activates_count
 * @property-read string $avatar
 * @property-read array $imgenvironments
 * @property-read array $imgmenus
 * @property-read array $imgothers
 * @property-read array $imgproducts
 * @property-read array $imgqualifications
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\xapp1s1\xapp1s1product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User $user_pub
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereApproval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereEndtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereStarttime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1shop whereUserId($value)
 */
class xapp1s1shop extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, InteractsWithUser;

    protected $fillable = [
        'user_id', 'name', 'starttime', 'endtime', 'status', 'phone', 'tel', 'province', 'city', 'district', 'addr', 'longitude', 'latitude', 'approval'
    ];

    protected $appends = ["avatar", "imgproducts", "imgenvironments", "imgmenus", "imgqualifications", "imgothers"];

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
        return $this->hasMany('App\Models\xapp1s1\xapp1s1product');
    }

    public function activates()
    {
        return $this->hasMany('App\Models\xapp1s1\xapp1s1activate');
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

    public function getImgproductsAttribute(): array
    {
        $aRet = [];
        $oMedias = $this->getMedia('products');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return $aRet;
    }

    public function getImgenvironmentsAttribute(): array
    {
        $aRet = [];
        $oMedias = $this->getMedia('environments');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return $aRet;
    }

    public function getImgmenusAttribute(): array
    {
        $aRet = [];
        $oMedias = $this->getMedia('menus');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return $aRet;
    }

    public function getImgqualificationsAttribute(): array
    {
        $aRet = [];
        $oMedias = $this->getMedia('qualifications');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return $aRet;
    }

    public function getImgothersAttribute(): array
    {
        $aRet = [];
        $oMedias = $this->getMedia('others');
        if (count($oMedias) > 0) {
            $oMedias->each(function ($oMedia) use (&$aRet) {
                $aRet[] = $oMedia->getFullUrl();
            });
        }
        return $aRet;
    }

}
