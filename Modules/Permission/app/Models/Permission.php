<?php

namespace Modules\Permission\App\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use ModelTrait;
    
    protected $fillable = [
        'name',
    ];

    protected static function boot()
    {
        parent::boot();
    }
}
