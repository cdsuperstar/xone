<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $fillable = ['content'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user_pub()
    {
        return $this->belongsTo('App\Models\User','user_id')->select(['id','created_at']);
    }

}
