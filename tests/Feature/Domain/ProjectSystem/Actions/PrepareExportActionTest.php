<?php

declare(strict_types=1);
// tests/Feature/Domain/ProjectSystem/Actions/PrepareExportActionTest.php

use App\Domain\ProjectSystem\Actions\PrepareExportAction;
use App\Domain\ProjectSystem\DTO\ExportResultDTO;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('handles export preparation correctly', function () {
    // Create a user with projects and tasks
    $user = User::factory()->hasProjects(2)->create();
    $user->projects->each(function ($project) {
        $project->task()->createMany([
            ['start_time' => '2023-01-01 08:00:00', 'end_time' => '2023-01-01 10:00:00'],
            ['start_time' => '2023-01-02 09:00:00', 'end_time' => '2023-01-02 11:00:00'],
        ]);
    });

    $action = new PrepareExportAction();
    $result = $action->handle($user->id);

    expect($result)->toBeInstanceOf(ExportResultDTO::class)
        ->and($result->projects)->toHaveCount(2)
        ->and($result->tasks)->toHaveCount(2)
        ->and($result->totalTimes)->toHaveCount(2);

    foreach ($result->totalTimes as $total_time) {
        expect($total_time)->toBe(14400); // 4 hours in seconds
    }
});

it('returns empty result if user not found', function () {
    $action = new PrepareExportAction();
    $result = $action->handle(999); // Non-existent user ID

    expect($result)->toBeInstanceOf(ExportResultDTO::class)
        ->and($result->projects)->toBeEmpty()
        ->and($result->tasks)->toBeEmpty()
        ->and($result->totalTimes)->toBeEmpty();
});
it('returns empty result if the user has no project', function () {
    $user = User::factory()->create();
    $action = new PrepareExportAction();
    $result = $action->handle($user->id);

    expect($result)->toBeInstanceOf(ExportResultDTO::class)
        ->and($result->projects)->toBeEmpty()
        ->and($result->tasks)->toBeEmpty()
        ->and($result->totalTimes)->toBeEmpty();
});
