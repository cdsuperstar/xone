<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait InteractsWithComment
{
    public function comments(): MorphMany
    {
        return $this->morphMany('App\Models\comment', 'commentable');
    }

    public function comment(): MorphOne
    {
        return $this->morphOne('App\Models\comment', 'commentable');
    }
}
?>
