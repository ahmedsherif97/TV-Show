<?php

namespace App\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

trait ModelTrait
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                ...$this->fillable
            ]);
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        // here you can add custom description
        // if ($this->isDirty('name')) {
        //     $activity->description = "name changed";
        //     $activity->event = "enabled";
        // }
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = $model->user_id ?? auth()->id() ?? NULL;
        });
        static::updating(function ($model) {
            $model->user_id = $model->user_id ?? auth()->id() ?? NULL;
        });
    }
}