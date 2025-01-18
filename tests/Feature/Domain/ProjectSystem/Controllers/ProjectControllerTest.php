<?php

declare(strict_types=1);

namespace Tests\Feature\Domain\ProjectSystem\Controllers;

use App\Domain\ProjectSystem\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
it('shows a project', function () {
    $project = Project::create([
        'name' => 'Project 1',
        'user_id' => 1,
    ]);

    $response = $this->get("/project/{$project->id}");
    $response->assertStatus(200);
    $response->assertViewIs('Domain.ProjectSystem.Views.show');

});
it('can create a project', function () {
    $response = $this->post('/project-save', [
        'project' => 'Project 1',
    ]);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('projects', [
        'name' => 'Project 1',
        'user_id' => 1,
    ]);
});
it('can change the latest task end time when reloading page', function () {
    $project = Project::create([
        'name' => 'Project 1',
        'user_id' => 1,
    ]);
    $task = $project->task()->create([
        'project_id' => $project->id,
        'start_time' => now(),
    ]);
    expect($task->end_time)->toBeNull();
    $response = $this->get("/project/{$project->id}");
    $response->assertStatus(200);
    expect($project->task()->where('id', $task->id)->first()->end_time)->not->toBeNull();

});
