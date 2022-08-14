<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait InteractsWithCateg
{
    public function categs(): MorphMany
    {
        return $this->morphMany('App\Models\xapp1s1categ', 'categable');
    }

    public function categ(): MorphOne
    {
        return $this->morphOne('App\Models\xapp1s1categ', 'categable');
    }
}
?>
