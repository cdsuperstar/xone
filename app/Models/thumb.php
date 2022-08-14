<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thumb extends Model
{
    use HasFactory, InteractsWithUser;
    protected $fillable = ['content'];

    public function thumbable()
    {
        return $this->morphTo();
    }
}
