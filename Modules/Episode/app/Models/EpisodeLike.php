<?php

namespace Modules\Episode\App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\TVShow\App\Models\TVShow;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class EpisodeLike extends Model
{
    protected $guarded = [];

}

