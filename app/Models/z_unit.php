<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class z_unit extends Model
{
    use HasFactory,NodeTrait;
    //
    protected $fillable = [
        'title', 'brief',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
