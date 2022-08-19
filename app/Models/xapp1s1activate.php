<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
        return $this->belongsTo('App\Models\xapp1s1shop', 'xapp1s1shop_id');
    }

    public function slots()
    {
        return $this->hasMany('App\Models\xapp1s1slot');
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
