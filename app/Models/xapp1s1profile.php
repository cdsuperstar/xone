<?php

namespace App\Models;

use App\Helper\Helper;
use App\Traits\InteractsWithUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use phpDocumentor\Reflection\Types\Integer;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


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
        'user_id', 'realname', 'idcard', 'phone', 'companyname', 'approval', 'nickname', 'height', 'incomebegin', 'incomeend', 'province', 'city', 'district', 'addr', 'eduback', 'marriage', 'nationality', 'career', 'nativeplace', 'weight', 'housesitu', 'carsitu', 'smokesitu', 'drinksitu', 'childrensitu', 'memo'
    ];
    protected $appends = ['avatar','age'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('userAvatar')
            ->singleFile();
    }

    public function getAgeAttribute(): int
    {
        if (isset($this->attributes['birthday'])){
            return Carbon::parse($this->attributes['birthday'])->age;
        }else{
            return 0;
        }
    }
    public function getAvatarAttribute(): string
    {
        if (count($this->getMedia('userAvatar')) > 0) {
            return $this->getMedia('userAvatar')[0]->getFullUrl();
        } else {
            return '/assets/default_avatar.jpg';
        }
    }

    public function setIdcardAttribute($tmpIdcard)
    {
        // 检测idcard需要更新
        $blIdcardUpdateAble = false;
        if (isset($this->attributes['idcard'])) {
            if ($this->attributes['idcard'] != $tmpIdcard) {
                $blIdcardUpdateAble = true;
            }
        } else {
            $blIdcardUpdateAble = true;
        }

        if ($blIdcardUpdateAble && strlen($tmpIdcard) == 18 && Helper::checkIdcard($tmpIdcard)) {
            $month = (int)substr($tmpIdcard, 10, 2);
            $day = (int)substr($tmpIdcard, 12, 2);
            if ($month < 1 || $month > 12 || $day < 1 || $day > 31) return false;

            $constellations = [
                '摩羯座', '水瓶座', '双鱼座', '白羊座', '金牛座', '双子座',
                '巨蟹座', '狮子座', '处女座', '天秤座', '天蝎座', '射手座',
            ];

            $endDays = [19, 18, 20, 20, 20, 21, 22, 22, 22, 22, 21, 21];
            if ($day <= $endDays[$month - 1]) {
                $constellation = $constellations[$month - 1];
            } else {
                $constellation = empty($constellations[$month]) ? $constellations[0] : $constellations[$month];
            }

            $this->attributes['birthday'] = substr($tmpIdcard, 6, 4) . "-" . substr($tmpIdcard, 10, 2) . "-" . substr($tmpIdcard, 12, 2);

            $this->attributes['constellation'] = $constellation;

            $sexint = (int)substr($tmpIdcard, -2, 1);
            $this->attributes['sex'] = $sexint % 2 === 0 ? '2' : '1';

            $this->attributes['idcard'] = $tmpIdcard;
        }
    }
}
