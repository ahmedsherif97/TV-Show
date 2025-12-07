<?php

namespace Modules\Episode\App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\TVShow\App\Models\TVShow;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Episode extends Model implements HasMedia
{
    use InteractsWithMedia, ModelTrait;

    protected $fillable = [
        'tv_show_id', 'title', 'slug', 'description',
        'duration_seconds', 'airing_at'
    ];

    protected $casts = [
        'airing_at' => 'datetime',
    ];

    public function tvShow()
    {
        return $this->belongsTo(TvShow::class);
    }

    public function likes()
    {
        return $this->hasMany(EpisodeLike::class);
    }

    public function getVideoAttribute()
    {
        return $this->getMedia('video')->first()->getUrl();
    }

    public function getThumbnailAttribute()
    {
        return $this->getMedia('thumbnail')->first()->getUrl();
    }
}

