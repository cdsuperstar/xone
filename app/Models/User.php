<?php

namespace App\Models;

use App\Traits\InteractsWithLike;
use App\Traits\xapp1s1\InteractsWithUserextend;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

// add by luke
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $usercfg
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\z_unit[] $units
 * @property-read int|null $units_count
 * @property-read \App\Models\z_userprofile|null $userprofile
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsercfg($value)
 * @mixin \Eloquent
 * @property-read \App\Models\like|null $like
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\like[] $likes
 * @property-read int|null $likes_count
 * @property-read \App\Models\oauth_access_token|null $oauth_access_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\xapp1s1\xapp1s1moment[] $xapp1s1moments
 * @property-read int|null $xapp1s1moments_count
 * @property-read \App\Models\xapp1s1\xapp1s1profile|null $xapp1s1profile
 * @property-read \App\Models\xapp1s1\xapp1s1profile|null $xapp1s1profile_pub
 * @property-read \App\Models\xapp1s1\xapp1s1shop|null $xapp1s1shop
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\xapp1s1\xapp1s1slot[] $xapp1s1slots
 * @property-read int|null $xapp1s1slots_count
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, HasRoles, InteractsWithLike, InteractsWithUserextend;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'usercfg', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userprofile()
    {
        return $this->hasOne('App\Models\z_userprofile', 'id');
    }

    public function units()
    {
        return $this->belongsToMany('App\Models\z_unit');
    }

    public function permissions(): MorphToMany
    {
        return $this->morphToMany(
            config('permission.models.permission'),
            'model',
            config('permission.table_names.model_has_permissions'),
            config('permission.column_names.model_morph_key'),
            'permission_id'
        )->withPivot('usrcfg');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('userTmpFiles');
    }

//    public function setPasswordAttribute($value)
//    {
//        if (env('APP_DEBUG')) {
//            \Log::info('Setting password attribute', [$this->attributes, $value]);
//        }
//        if ($this->attributes['password'] != $value)
//            $this->attributes['password'] = Hash::make($value);
////            $this->attributes['password'] = bcrypt($value);
//    }

    public function oauth_access_token()
    {
        return $this->hasOne('App\Models\oauth_access_token', 'user_id')->select(['user_id', 'created_at']);

    }
}
