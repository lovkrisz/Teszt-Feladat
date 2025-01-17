<?php

// tests/Feature/Domain/ProjectSystem/Actions/UpdateTaskTimesTest.php

use App\Domain\ProjectSystem\Actions\UpdateTaskTimes;
use App\Domain\ProjectSystem\Models\Project;
use App\Domain\ProjectSystem\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('updates the start and end times of a task', function () {
    $project = Project::factory()->create();
    $task = Task::create([
        'project_id' => $project->id,
        'start_time' => '2023-01-01 08:00:00',
        'end_time' => '2023-01-01 10:00:00',
    ]);

    $action = new UpdateTaskTimes();
    $action->handle($task, '2023-01-02 09:00:00', '2023-01-02 11:00:00');

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'start_time' => '2023-01-02 09:00:00',
        'end_time' => '2023-01-02 11:00:00',
    ]);
});

it('does not update times if task not found', function () {
    $action = new UpdateTaskTimes();
    $nonExistentTask = new Task(['id' => 999]);

    $action->handle($nonExistentTask, '2023-01-02 09:00:00', '2023-01-02 11:00:00');

    $this->assertDatabaseMissing('tasks', [
        'id' => 999,
        'start_time' => '2023-01-02 09:00:00',
        'end_time' => '2023-01-02 11:00:00',
    ]);
});
