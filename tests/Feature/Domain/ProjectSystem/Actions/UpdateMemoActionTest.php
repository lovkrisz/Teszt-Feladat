<?php

declare(strict_types=1);
// tests/Feature/Domain/ProjectSystem/Actions/UpdateMemoActionTest.php

use App\Domain\ProjectSystem\Actions\UpdateMemoAction;
use App\Domain\ProjectSystem\Models\Project;
use App\Domain\ProjectSystem\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('updates the memo of a task', function () {
    $project = Project::factory()->create();
    $task = Task::create([
        'project_id' => $project->id,
    ]);

    $action = new UpdateMemoAction();
    $action->handle($project, 'Updated memo', $task->id);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'memo' => 'Updated memo',
    ]);
});

it('does not update memo if task not found', function () {
    $project = Project::factory()->create();

    $action = new UpdateMemoAction();
    $action->handle($project, 'Updated memo', 999); // Non-existent task ID

    $this->assertDatabaseMissing('tasks', [
        'memo' => 'Updated memo',
    ]);
});
