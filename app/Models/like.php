<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory, InteractsWithUser;
    protected $fillable = ['content'];

    public function likeable()
    {
        return $this->morphTo();
    }
}
