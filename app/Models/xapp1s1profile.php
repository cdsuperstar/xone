<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class xapp1s1profile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'realname', 'idcard', 'phone', 'companyname', 'avatar', 'nickname', 'sex', 'height', 'incomebegin', 'incomeend', 'workaddress', 'eduback', 'marriage', 'nationality', 'career', 'nativeplace', 'weight', 'housesitu', 'carsitu', 'smokesitu', 'drinksitu', 'childrensitu', 'memo'
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('userAvatars');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }
}
