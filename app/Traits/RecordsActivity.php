<?php

namespace App\Traits;

use App\Activity;

trait RecordsActivity
{

    /**
     * @var array
     */
    public $oldAttributes = [];

    /**
     * Boot the trait.
     */
    public static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->activityDescription($event));
            });
        }

        if ($event === 'updated') {
            static::updating(function ($model) {
                $model->oldAttributes = $model->getOriginal();
            });
        }
    }

    /**
     * @return string[]
     */
    protected static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }

        return ['created', 'updated', 'deleted'];
    }

    /**
     * @param $description
     *
     * @return string
     */
    protected function activityDescription($description)
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    /**
     * @param $description
     */
    public function recordActivity($description
    ) {
        $this->activity()->create([
            'user_id'     => ($this->project ?? $this)->owner->id,
            'description' => $description,
            'changes'     => $this->getActivityChanges(),
            'project_id'  => class_basename($this) === 'Project' ? $this->id : $this->project_id,
        ]);
    }

    /**
     *
     * @return array|null
     */
    protected function getActivityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => array_except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after'  => array_except($this->getChanges(), 'updated_at'),
            ];
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }
}
