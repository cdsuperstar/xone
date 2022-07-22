<?php

namespace App\Models;

use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    //
    protected $hidden = ['pivot','updated_at','created_at'];

    public function modules()
    {
        return $this->belongsToMany('App\Models\z_module');
    }
}
