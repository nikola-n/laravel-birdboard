<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_invite_a_user()
    {
        $project = ProjectFactory::create();
        //owner of the projects invites another user
        $project->invite($newUser = factory(User::class)->create());
        //then, that new user will have permissions to add task
        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project, $task = ['body' => 'Foo task']));

        $this->assertDatabaseHas('tasks', $task);
    }
}
