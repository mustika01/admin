<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Employee::class;

    public function definition(): array
    {
        return [

            // 'name' => $this->faker->unique()->randomElement([
            //     'Marketing',
            //     'Sales',
            //     'Finance',
            //     'Human Resource',
            //     'Purchasing',
            //     'Operational',
            //     'IT',
            // ]),

            'name' => $this->faker->name(),
            'tag' => $this->faker->word(),
            'tag' => $this->faker->email(),

            // 'department_id' => Department::factory(),
            // 'position_id' => Position::factory(),

            'mobile' => '62' . $this->faker->randomElement(['812', '823', '834']) . $this->faker->numberBetween(0, 99999999),
            'phone' => '62' . $this->faker->randomElement(['812', '823', '834']) . $this->faker->numberBetween(0, 99999999),
        ];
    }
}
