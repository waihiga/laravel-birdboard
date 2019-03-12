<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_has_a_path()
    {
        $project = factory(Project::class)->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    public function test_a_project_belongs_to_an_owner()
    {
        $project = factory(Project::class)->create();

        $this->assertInstanceOf(User::class, $project->owner);
    }

    public function test_it_can_add_a_task()
    {
        $project = factory('App\Project')->create();

        $tasks = $project->addTask('Task test');

        $this->assertCount(1, $project->tasks);

        $this->assertTrue($project->tasks->contains($tasks));
    }
}
