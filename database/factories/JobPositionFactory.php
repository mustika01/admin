<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPosition>
 */
class JobPositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Position::class;

    public function definition(): array
    {
        return [
            'department_id' => Department::factory(),

            'name' => $this->faker->jobTitle(),
            'level' => 1,
        ];
    }
}
