<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


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

