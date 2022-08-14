<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory, InteractsWithUser;
    protected $fillable = ['content'];

    public function commentable()
    {
        return $this->morphTo();
    }

}
