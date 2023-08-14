<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\xapperr
 *
 * @property int $id
 * @property string|null $message
 * @property string|null $stack
 * @property string|null $info
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|xapperr newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapperr newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapperr query()
 * @method static \Illuminate\Database\Eloquent\Builder|xapperr whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapperr whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapperr whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapperr whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapperr whereStack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapperr whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class xapperr extends Model
{
    protected $fillable = [
        'message','stack','info'
    ];
    use HasFactory;
}
