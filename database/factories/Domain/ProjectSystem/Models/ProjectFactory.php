<?php

namespace Database\Factories\Domain\ProjectSystem\Models;

use App\Domain\ProjectSystem\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProjectFactory extends Factory
{
	protected $model = Project::class;

	public function definition(): array
    {
		return [
			'name' => $this->faker->name(),
			'user_id' => '1',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		];
	}
}
