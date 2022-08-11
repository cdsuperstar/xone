<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class xapp1s1moment extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['note','type'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('pics');
    }

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
//        return $date->toW3cString();
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
