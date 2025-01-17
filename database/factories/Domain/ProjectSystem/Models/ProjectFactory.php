<?php

declare(strict_types=1);

namespace Database\Factories\Domain\ProjectSystem\Models;

use App\Domain\ProjectSystem\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

final class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(1, true),
            'user_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
