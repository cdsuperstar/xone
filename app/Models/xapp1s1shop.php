<?php

namespace App\Models;

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
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name','starttime','endtime','status','phone','tel','addr','longitude','latitude'
    ];
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('shopAvatar')
            ->addMediaCollection('products')
            ->addMediaCollection('environments')
            ->addMediaCollection('menus')
            ->addMediaCollection('qualifications');
    }

    public function products() {
        return $this->hasMany('App\Models\xapp1s1product');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }
}
