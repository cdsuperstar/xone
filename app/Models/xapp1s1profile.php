<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * App\Models\xapp1s1profile
 *
 * @property int $id
 * @property string $realname
 * @property string|null $idcard
 * @property string|null $phone
 * @property string|null $companyname
 * @property string $avatar
 * @property string $nickname
 * @property string|null $sex
 * @property int|null $height
 * @property int|null $incomebegin
 * @property int|null $incomeend
 * @property string|null $workaddress
 * @property string|null $eduback
 * @property string|null $marriage
 * @property string|null $nationality
 * @property string|null $career
 * @property string|null $nativeplace
 * @property int|null $weight
 * @property string|null $housesitu
 * @property string|null $carsitu
 * @property string|null $smokesitu
 * @property string|null $drinksitu
 * @property string|null $childrensitu
 * @property string|null $memo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereCareer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereCarsitu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereChildrensitu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereCompanyname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereDrinksitu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereEduback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereHousesitu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereIdcard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereIncomebegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereIncomeend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereMarriage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereNativeplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereRealname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereSmokesitu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1profile whereWorkaddress($value)
 * @mixin \Eloquent
 */
class xapp1s1profile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, InteractsWithUser;

    protected $fillable = [
        'realname', 'idcard', 'phone', 'companyname', 'approval', 'avatar', 'nickname', 'sex', 'height', 'incomebegin', 'incomeend', 'workaddress', 'eduback', 'marriage', 'nationality', 'career', 'nativeplace', 'weight', 'housesitu', 'carsitu', 'smokesitu', 'drinksitu', 'childrensitu', 'memo'
    ];
    protected $appends = ['avatar'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('userAvatar')
            ->singleFile();
    }

    public function getAvatarAttribute(): string
    {
        if(count($this->getMedia('userAvatar'))>0){
            return $this->getMedia('userAvatar')[0]->getFullUrl();
        }else{
            return '/assets/default_avatar.jpg';
        }
    }
}
