<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Episode\App\Models\EpisodeLike;
use Modules\Permission\App\Models\Permission;
use Modules\TVShow\App\Models\TvShow;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Modules\User\App\Models\User as ModuleUser;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use HasPermissions;
    use ModuleUser;
    use InteractsWithMedia;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($user) {
            if (auth()->check()) {
                $user->email_verified_at = now();
            }
        });
    }


    public function getAllPermissions()
    {
        $permissions = $this->permissions;

        if (method_exists($this, 'roles')) {
            $permissions = $permissions->merge($this->getPermissionsViaRoles());
        }

        if ($this->hasRole('super-admin')) {
            $permissions = Permission::get();
        }

        return $permissions->sort()->values();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userable()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }

    public function followedShows()
    {
        return $this->belongsToMany(TvShow::class, 'tv_show_follows')
            ->withTimestamps();
    }

    public function episodeLikes()
    {
        return $this->hasMany(EpisodeLike::class);
    }

}
