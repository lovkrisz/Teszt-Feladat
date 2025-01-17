<?php

declare(strict_types=1);

namespace App\Domain\ProjectSystem\Actions;

use App\Domain\ProjectSystem\Models\Project;

final class UpdateMemoAction
{
    public function handle(Project $project, string $memo, int $taskId): void
    {
        $project->task()->find($taskId)->update(['memo' => $memo]);
    }
}
