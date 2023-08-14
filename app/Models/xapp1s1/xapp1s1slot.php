<?php

namespace App\Models\xapp1s1;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\xapp1s1\xapp1s1slot
 *
 * @property int $id
 * @property int|null $xapp1s1activate_id
 * @property int|null $user_id
 * @property string|null $price
 * @property string|null $note
 * @property int|null $agebegin
 * @property int|null $ageend
 * @property string|null $constellation
 * @property string|null $sex
 * @property int|null $heightbegin
 * @property int|null $heightend
 * @property int|null $incomebegin
 * @property int|null $incomeend
 * @property string|null $eduback
 * @property string|null $marriage
 * @property string|null $career
 * @property int|null $weightbegin
 * @property int|null $weightend
 * @property string|null $housesitu
 * @property string|null $carsitu
 * @property string|null $smokesitu
 * @property string|null $drinksitu
 * @property string|null $childrensitu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\xapp1s1\xapp1s1activate|null $active
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $user_pub
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot query()
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereAgebegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereAgeend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereCareer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereCarsitu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereChildrensitu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereConstellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereDrinksitu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereEduback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereHeightbegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereHeightend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereHousesitu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereIncomebegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereIncomeend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereMarriage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereSmokesitu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereWeightbegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereWeightend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|xapp1s1slot whereXapp1s1activateId($value)
 * @mixin \Eloquent
 */
class xapp1s1slot extends Model
{
    use HasFactory, InteractsWithUser;

    protected $fillable = ['price', 'note', 'agebegin', 'ageend', 'constellation', 'sex', 'heightbegin', 'heightend', 'incomebegin', 'incomeend', 'eduback', 'marriage', 'career', 'weightbegin', 'weightend', 'housesitu', 'carsitu', 'smokesitu', 'drinksitu', 'childrensitu'];


    public function active()
    {
        return $this->belongsTo('App\Models\xapp1s1\xapp1s1activate', 'xapp1s1activate_id');
    }
}
