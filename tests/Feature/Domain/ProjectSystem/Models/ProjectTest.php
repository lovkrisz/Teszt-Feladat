<?php

declare(strict_types=1);

// tests/Unit/Domain/ProjectSystem/Models/ProjectTest.php

use App\Domain\ProjectSystem\Models\Project;
use App\Domain\ProjectSystem\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has a user', function () {
    $user = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $user->id]);

    expect($project->user)->toBeInstanceOf(User::class)
        ->and($project->user->id)->toBe($user->id);
});

it('has many tasks', function () {
    $project = Project::factory()->create();
    Task::create(['project_id' => $project->id]);
    Task::create(['project_id' => $project->id]);
    Task::create(['project_id' => $project->id]);

    expect($project->task)->toHaveCount(3);
});
