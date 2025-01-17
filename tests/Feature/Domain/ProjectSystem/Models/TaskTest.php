<?php

declare(strict_types=1);

// tests/Unit/Domain/ProjectSystem/Models/TaskTest.php

use App\Domain\ProjectSystem\Models\Project;
use App\Domain\ProjectSystem\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('belongs to a project', function () {
    $project = Project::factory()->create();
    $task = Task::create(['project_id' => $project->id]);

    expect($task->project)->toBeInstanceOf(Project::class)
        ->and($task->project->id)->toBe($project->id);
});

it('has correct casts for start_time and end_time', function () {
    $task = Task::create([
        'project_id' => '1',
        'start_time' => '2023-01-01 08:00:00',
        'end_time' => '2023-01-01 10:00:00',
    ]);

    expect($task->start_time->format('Y-m-d H:i:s'))->toBe('2023-01-01 08:00:00')
        ->and($task->end_time->format('Y-m-d H:i:s'))->toBe('2023-01-01 10:00:00');
});
