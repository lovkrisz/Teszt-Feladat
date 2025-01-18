<?php

declare(strict_types=1);

use App\Domain\ProjectSystem\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a task', function () {
    $project = Project::factory()->create();
    $post = $this->post('/task/create', ['projectId' => $project->id]);
    expect($project->task()->count())->toBe(1);
});

it('saves a memo', function () {
    $project = Project::factory()->create();
    $task = $project->task()->create(['project_id' => $project->id, 'start_time' => now()]);

    $this->post('/task/savememo', ['projectId' => $project->id, 'memo' => 'test memo']);
    expect($project->task()->where('id', $task->id)->first()->memo)->toBe('test memo');
});

it('sets end time', function () {
    $project = Project::factory()->create();
    $task = $project->task()->create(['project_id' => $project->id, 'start_time' => now()]);
    $this->post('/task/setendtime', ['projectId' => $project->id]);
    expect($project->task()->where('id', $task->id)->first()->end_time)->not()->toBeNull();

});
