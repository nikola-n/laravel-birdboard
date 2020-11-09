<?php

namespace App;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordsActivity;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected static $recordableEvents = ['created', 'deleted'];

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Request|string
     */
    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Request|string
     */
    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->recordActivity('incompleted_task');
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
