<?php
namespace App\Traits;

trait InteractsWithUser
{
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function user_pub()
    {
        return $this->belongsTo('App\Models\User','user_id')->select(['id','created_at']);
    }
}
?>
