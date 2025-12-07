<?php

namespace Modules\Media\App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use ModelTrait;

    protected $fillable = [
        'key', 'name', 'type', 'size'
    ];

    public function mediable()
    {
        return $this->morphTo();
    }

    protected static function boot()
    {
        parent::boot();
    }
}
