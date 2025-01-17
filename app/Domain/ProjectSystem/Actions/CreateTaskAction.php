<?php

declare(strict_types=1);

namespace App\Domain\ProjectSystem\Actions;

use App\Domain\ProjectSystem\Models\Project;
use Carbon\Carbon;

final class CreateTaskAction
{
    public function handle(Project $project): int
    {
        /**
         * Create a new task for the project
         *
         * @param  Project  $project
         * @return int
         */
        return $project->task()->create([
            'project_id' => $project->id,
            'start_time' => Carbon::now()->format('Y-m-d H:i:s'),
        ])->id;

    }
}
