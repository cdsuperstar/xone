<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait InteractsWithThumb
{
    public function thumbs(): MorphMany
    {
        return $this->MorphMany('App\Models\thumb', 'thumbable');
    }
}
?>
