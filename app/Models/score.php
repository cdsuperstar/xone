<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class score extends Model
{
    use HasFactory, InteractsWithUser;
    protected $fillable = ['content'];

    public function scoreable()
    {
        return $this->morphTo();
    }
}
