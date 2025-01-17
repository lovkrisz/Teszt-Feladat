<?php

declare(strict_types=1);

namespace Tests\Feature\Domain\ProjectSystem\Controllers;

use App\Domain\ProjectSystem\Models\Project;

it('shows a project', function () {
    $project = Project::create([
        'name' => 'Project 1',
        'user_id' => 1,
    ]);

    $response = $this->get("/project/{$project->id}");
    $response->assertStatus(200);
    $response->assertViewIs('Domain.ProjectSystem.Views.show');
    $response->assertViewHas('project', $project);
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
