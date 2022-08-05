<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


/**
 * App\Models\z_userprofile
 *
 * @property int $id
 * @property string|null $no
 * @property string $avatar
 * @property string $name
 * @property string|null $sex
 * @property string|null $position
 * @property string|null $title
 * @property string|null $jobs
 * @property int|null $unitid
 * @property string|null $phone
 * @property string|null $tel
 * @property string|null $birth
 * @property string|null $address
 * @property string|null $memo
 * @property string|null $companyname
 * @property string|null $province
 * @property string|null $city
 * @property string|null $area
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile query()
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereCompanyname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereJobs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereUnitid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|z_userprofile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class z_userprofile extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    //
    protected $fillable = [
        'no','avatar','name','sex','position','title','jobs','unitid','phone','tel','birth','address','memo','companyname','province','city','area'
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('userAvatars')
            ->singleFile();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }
}

