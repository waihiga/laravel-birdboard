<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    function test_only_the_owner_of_project_can_add_tasks()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->post($project->path() . '/tasks', [
            'body' => 'Test Task'
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'body' => 'Test Task'
        ]);
    }

    public function test_a_project_can_have_tasks()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $project = auth()->user()->projects()->create(factory(Project::class)->raw());

        $this->post($project->path() . '/tasks', [
            'body' => 'Test Task'
        ]);

        $this->get($project->path())
            ->assertSee('Test Task');
    }

    public function test_task_required_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(factory(Project::class)->raw());

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
