<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
        return $this->belongsTo('App\Models\xapp1s1shop');
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
