<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\ProjectSystem\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

final class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'project_id' => $this->faker->randomNumber(),
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now(),
            'memo' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
