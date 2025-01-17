<?php

declare(strict_types=1);

// tests/Feature/Livewire/Domain/ProjectSystem/ShowTaskComponentTest.php

use App\Domain\ProjectSystem\Models\Project;
use App\Domain\ProjectSystem\Models\Task;
use App\Livewire\Domain\ProjectSystem\ShowTaskComponent;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('saves memo for an existing task', function () {
    $project = Project::factory()->create();
    $task = Task::create(['project_id' => $project->id, 'start_time' => '2025-01-17 21:00:00', 'end_time' => '2025-01-17 23:00:00']);

    Livewire::test(ShowTaskComponent::class, ['project' => $project])
        ->set('taskId', $task->id)
        ->set('memo', 'Updated memo')
        ->call('saveMemo');

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'memo' => 'Updated memo',
    ]);
});

it('creates a new task and saves memo', function () {
    $project = Project::factory()->create();

    Livewire::test(ShowTaskComponent::class, ['project' => $project])
        ->set('memo', 'New memo')
        ->call('saveMemo');

    $this->assertDatabaseHas('tasks', [
        'project_id' => $project->id,
    ]);
});

it('sets end time for a task', function () {
    $project = Project::factory()->create();
    $task = Task::create(['project_id' => $project->id, 'start_time' => '2025-01-17 21:00:00']);

    Livewire::test(ShowTaskComponent::class, ['project' => $project])
        ->set('taskId', $task->id)
        ->call('setEndTime');

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'end_time' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);
});
it('can create a task', function () {
    $project = Project::factory()->create();
    Livewire::test(ShowTaskComponent::class, ['project' => $project])
        ->call('createTask');
    $this->assertDatabaseHas('tasks', [
        'project_id' => $project->id,
    ]);
});
