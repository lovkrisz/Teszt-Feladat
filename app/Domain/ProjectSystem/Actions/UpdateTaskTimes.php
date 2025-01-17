<?php

declare(strict_types=1);

namespace App\Domain\ProjectSystem\Actions;

use App\Domain\ProjectSystem\Models\Task;

final class UpdateTaskTimes
{
    public function handle(Task $task, string $startTime, string $endTime): void
    {
        $task->update([
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);
    }
}
