<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xapp1s1slot extends Model
{
    use HasFactory, InteractsWithUser;

    protected $fillable = ['price', 'note', 'agebegin', 'ageend', 'constellation', 'sex', 'heightbegin', 'heightend', 'incomebegin', 'incomeend', 'eduback', 'marriage', 'career', 'weightbegin', 'weightend', 'housesitu', 'carsitu', 'smokesitu', 'drinksitu', 'childrensitu'];


    public function active()
    {
        return $this->belongsTo('App\Models\xapp1s1activate', 'xapp1s1activate_id');
    }
}
