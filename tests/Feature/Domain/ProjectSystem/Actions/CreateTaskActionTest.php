<?php

use App\Domain\ProjectSystem\Actions\CreateTaskAction;
use App\Domain\ProjectSystem\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('it creates a task', function () {

    $user = User::factory()->create();
    $project = Project::factory()->create();

    $action = new CreateTaskAction();
    $taskId = $action->handle($project);

    expect($taskId)->toBeInt()
        ->and($project->task->count())->toBe(1)
        ->and($project->task->first()->id)->toBe($taskId)
        ->and($project->task->first()->project_id)->toBe($project->id)
        ->and($taskId)->toBe(1);

});
