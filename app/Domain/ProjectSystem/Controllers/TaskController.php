<?php

declare(strict_types=1);

namespace App\Domain\ProjectSystem\Controllers;

use App\Domain\ProjectSystem\Actions\CreateTaskAction;
use App\Domain\ProjectSystem\Actions\UpdateMemoAction;
use App\Domain\ProjectSystem\Actions\UpdateTaskTimes;
use App\Domain\ProjectSystem\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

final class TaskController
{
    public function create(Request $request): void
    {
        $projectId = $request->projectId;
        $project = Project::find($projectId);
        app(CreateTaskAction::class)->handle($project);
    }

    public function saveMemo(Request $request): void
    {
        $projectId = $request->projectId;
        $memo = $request->memo;

        $project = Project::find($projectId);
        $taskId = $project->task()->where('end_time', null)->first()->id;

        app(UpdateMemoAction::class)->handle($project, $memo, $taskId);
    }

    public function setEndTime(Request $request): void
    {
        $projectId = $request->projectId;
        $project = Project::find($projectId);
        $task = $project->task()->where('end_time', null)->first();
        app(UpdateTaskTimes::class)->handle($task, (string) $task->start_time, Carbon::now()->format('Y-m-d H:i:s'));
    }
}
