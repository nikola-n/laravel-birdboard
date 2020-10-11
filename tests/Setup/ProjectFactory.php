<?php

namespace Tests\Setup;

use App\Project;
use App\Task;
use App\User;

class ProjectFactory
{
    protected $TasksCount = 0;

    protected $user;

    public function withTasks($count)
    {
        $this->TasksCount = $count;

        return $this;
    }

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    public function create()
    {
        $project = factory(Project::class)->create([
            'owner_id' => $this->user ?? factory(User::class)->create()->id,
        ]);

        factory(Task::class, $this->TasksCount)->create([
            'project_id' => $project->id,
        ]);

        return $project;
    }
}
