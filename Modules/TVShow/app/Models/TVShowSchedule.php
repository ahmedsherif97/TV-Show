<?php

namespace Modules\TVShow\App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class TVShowSchedule extends Model
{
    use ModelTrait;

    protected $table = 'tv_show_schedules';
    protected $guarded = [];

    public function tvShow()
    {
        return $this->belongsTo(TVShow::class);
    }

    protected static function boot()
    {
        parent::boot();
    }
}
