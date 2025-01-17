<?php

namespace App\Livewire;

use App\Domain\ProjectSystem\Actions\CreateTaskAction;
use App\Domain\ProjectSystem\Models\Project;
use Illuminate\View\View;
use Livewire\Component;

class ShowTaskComponent extends Component
{

    public Project $project;
    public string $memo = '';

    public  $task_id = 0;


    public function createTask(): void
    {
        $this->task_id = 10;
        //$action = new CreateTaskAction();
        //$this->task_id = $action($this->project);
    }
    public function render(): View
    {
        return view('livewire.show-task-component');
    }
}
