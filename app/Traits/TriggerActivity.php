<?php

namespace App\Traits;

use App\Activity;

trait TriggerActivity
{

    public static function bootTriggerActivity()
    {
        foreach (static::getModelEventsToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity(
                    $model->formatActivityDescription($event)
                );
            });
        }
    }

    public function recordActivity($description)
    {
        $this->activitySubject()
            ->activity()
            ->create(compact('description'));
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function activitySubject()
    {
        return $this;
    }

    public static function getModelEventsToRecord()
    {
        if (isset(static::$modelEventsToRecord)) {
            return static::$modelEventsToRecord;
        }
        return ['created', 'updated', 'deleted'];
    }

    public function formatActivityDescription($event)
    {
        return "{$event}_" . strtolower(class_basename($this));
    }
}
