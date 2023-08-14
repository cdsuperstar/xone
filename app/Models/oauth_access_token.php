<?php

namespace App\Models;

use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\oauth_access_token
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $client_id
 * @property string|null $name
 * @property string|null $scopes
 * @property bool $revoked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $expires_at
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $user_pub
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token query()
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token whereRevoked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token whereScopes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|oauth_access_token whereUserId($value)
 * @mixin \Eloquent
 */
class oauth_access_token extends Model
{
    use HasFactory, InteractsWithUser;

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
