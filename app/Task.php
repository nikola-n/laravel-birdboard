<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * return void
     */
    protected static function booted()
    {
        static::created(function ($task) {
            $task->project->recordActivity('created_task');
        });

    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Request|string
     */
    public function complete()
    {
        $this->update(['completed' => true]);

        $this->project->recordActivity('completed_task');
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Request|string
     */
    public function incomplete()
    {
        $this->update(['completed' => false]);

        //$this->project->recordActivity('incompleted_task');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @var string[]
     */
    protected $touches = ['project'];

    /**
     * @var string[]
     */
    protected $casts = [
        'completed' => 'boolean',
    ];

    /**
     * @return string
     */
    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
}
