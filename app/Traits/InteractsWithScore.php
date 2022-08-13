<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait InteractsWithScore
{
    public function score(): MorphOne
    {
        return $this->morphOne('App\Models\score', 'scoreable');
    }
}
?>
