<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class xapp1s1activate extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name', 'description', 'tagprice', 'price', 'timebegin', 'timeend', 'address', 'slot'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('pics');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\xapp1s1shop','xapp1s1shop_id');
    }

    public function slots()
    {
        return $this->hasMany('App\Models\xapp1s1slot');
    }
}
