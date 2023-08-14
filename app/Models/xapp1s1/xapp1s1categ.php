<?php

namespace App\Models\xapp1s1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\xapp1s1categ
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $memo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1categ newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1categ newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1categ query()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1categ whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1categ whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1categ whereMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1categ whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1categ whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $categable_type
 * @property int $categable_id
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1categ whereCategableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1categ whereCategableType($value)
 */
class xapp1s1categ extends Model
{
    protected $fillable = [
        'name','memo',
    ];

    use HasFactory;
}
