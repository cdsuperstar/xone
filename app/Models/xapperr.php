<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xapperr extends Model
{
    protected $fillable = [
        'message','stack','info'
    ];
    use HasFactory;
}
