<?php
namespace App\Traits\xapp1s1;

trait InteractsWithUserextend
{
    public function xapp1s1moments()
    {
        return $this->hasMany('App\Models\xapp1s1\xapp1s1moment');
    }

    public function xapp1s1slots()
    {
        return $this->hasMany('App\Models\xapp1s1\xapp1s1slot');
    }

    public function xapp1s1shop()
    {
        return $this->hasOne('App\Models\xapp1s1\xapp1s1shop');
    }

    public function xapp1s1profile_pub()
    {
        return $this->hasOne('App\Models\xapp1s1\xapp1s1profile', 'user_id')->select(['id', 'user_id', 'birthday', 'constellation', 'sex', 'nickname', 'height', 'incomebegin', 'incomeend', 'province', 'city', 'district', 'addr', 'eduback', 'marriage', 'nationality', 'career', 'nativeplace', 'weight', 'housesitu', 'carsitu', 'smokesitu', 'drinksitu', 'childrensitu']);
    }

    public function xapp1s1profile()
    {
        return $this->hasOne('App\Models\xapp1s1\xapp1s1profile', 'user_id');
    }
}

?>
