<?php

namespace App\Domain\ProjectSystem\Actions;

use App\Domain\ProjectSystem\Models\Project;

class CreateTaskAction
{
    public function __invoke(Project $project): int  {
        return $project->task()->create([
            'project_id' => $project->id,
        ])->id;

    }
}
