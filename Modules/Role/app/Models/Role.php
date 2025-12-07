<?php

namespace Modules\Role\App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use ModelTrait;

    protected static function boot()
    {
        parent::boot();
    }
}
