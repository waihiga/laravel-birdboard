<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectTest extends TestCase
{
    use  WithFaker, RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_guest_cannot_manage_project()
    {
        $project = factory(Project::class)->create();

        $this->get('/projects/create')->assertRedirect('login');

        $this->get($project->path())->assertRedirect('login');

        $this->get('/projects')->assertRedirect('login');

        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

    public function test_a_user_can_create_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $this->get('projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_an_authenticated_user_cannot_view_projects_of_others()
    {
        $this->be(factory(User::class)->create());

        $project = factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_a_user_can_view_their_projects()
    {
        $this->be(factory(User::class)->create());

        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_a_project_requires_title()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Project::class)->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_description()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Project::class)->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
