<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait InteractsWithLike
{
    public function like(): MorphOne
    {
        return $this->MorphOne('App\Models\like', 'likeable');
    }

    public function likes(): MorphMany
    {
        return $this->MorphMany('App\Models\like', 'likeable');
    }
}
?>
