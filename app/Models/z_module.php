<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kalnoy\Nestedset\NodeTrait;

class z_module extends Model
{
    //
    use HasFactory, NodeTrait;

    protected $fillable = [
        'name', 'title', 'tip', 'ismenu', 'icon', 'url', 'memo', 'syscfg', 'usercfg',
    ];

    protected $hidden = ['pivot', 'updated_at', 'created_at'];


    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
}
