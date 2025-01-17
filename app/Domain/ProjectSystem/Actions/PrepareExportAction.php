<?php

declare(strict_types=1);

namespace App\Domain\ProjectSystem\Actions;

use App\Domain\ProjectSystem\DTO\ExportResultDTO;
use App\Domain\ProjectSystem\HelperClasses\TimeDiffCalculator;
use App\Models\User;

final class PrepareExportAction
{
    public function handle(int $userid): ExportResultDTO
    {
        $user = User::find($userid);
        if (! $user) {
            return new ExportResultDTO([], [], []);
        }
        $projects = $user->projects;
        if ($projects->isEmpty()) {
            return new ExportResultDTO([], [], []);
        }
        $tasks = [];
        $total_times = [];
        foreach ($projects as $project) {
            $tasks[$project->name] = $project->task->toArray();
        }

        foreach ($tasks as $project_name => $task) {
            $total_time = 0;
            $calculator = new TimeDiffCalculator();
            foreach ($task as $t) {
                $total_time += $calculator->calculate($t['start_time'], $t['end_time'])->getResult();
            }
            $total_times[$project_name] = $total_time;
        }

        return new ExportResultDTO($projects->toArray(), $tasks, $total_times);

    }
}
