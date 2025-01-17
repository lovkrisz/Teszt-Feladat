<?php

declare(strict_types=1);

namespace App\Livewire\Domain\ProjectSystem;

use App\Domain\ProjectSystem\Actions\CreateTaskAction;
use App\Domain\ProjectSystem\Actions\UpdateMemoAction;
use App\Domain\ProjectSystem\Actions\UpdateTaskTimes;
use App\Domain\ProjectSystem\Models\Project;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

final class ShowTaskComponent extends Component
{
    public Project $project;

    public string $memo = '';

    public int $taskId = 0;

    public bool $firstRender = true;

    public function saveMemo(): void
    {
        if ($this->taskId !== 0) {
            app(UpdateMemoAction::class)->handle($this->project, $this->memo, $this->taskId);
        } else {
            $this->taskId = (int) app(CreateTaskAction::class)->handle($this->project);
        }
    }

    public function createTask(): void
    {
        $this->taskId = (int) app(CreateTaskAction::class)->handle($this->project);
    }

    public function fillData(): void
    {
        $taskCount = $this->project->task()->count();
        if ($taskCount > 0) {
            $latestTask = $this->project->task()->latest()->first();
            if ($latestTask->end_time === null) {
                app(UpdateTaskTimes::class)->handle($latestTask, (string) $latestTask->start_time, Carbon::now()->format('Y-m-d H:i:s'));
                $this->taskId = $latestTask->id;
                if ($latestTask->memo !== null) {
                    $this->memo = $latestTask->memo;
                }
            }
        }
    }

    public function setEndTime(): void
    {
        $task = $this->project->task()->find($this->taskId);
        app(UpdateTaskTimes::class)->handle($task, (string) $task->start_time, Carbon::now()->format('Y-m-d H:i:s'));
    }

    public function render(): View
    {
        if ($this->firstRender) {
            $this->firstRender = false;
            $this->fillData();
        }

        return view('Domain.ProjectSystem.Views.livewire.show-task-component');
    }
}
