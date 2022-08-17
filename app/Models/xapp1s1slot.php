<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xapp1s1slot extends Model
{
    use HasFactory;
    protected $fillable = ['req','price','note'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function active(){
        return $this->belongsTo('App\Models\xapp1s1activate');
    }
}
