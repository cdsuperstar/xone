<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait InteractsWithThumb
{
    public function thumb(): MorphOne
    {
        return $this->morphOne('App\Models\thumb', 'thumbable');
    }
}
?>
