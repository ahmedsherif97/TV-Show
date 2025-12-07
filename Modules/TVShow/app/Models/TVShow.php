<?php

namespace Modules\TVShow\App\Models;

use App\Models\User;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Episode\App\Models\Episode;

class TvShow extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'is_active'];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function schedules()
    {
        return $this->hasMany(TvShowSchedule::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'tv_show_follows')
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

