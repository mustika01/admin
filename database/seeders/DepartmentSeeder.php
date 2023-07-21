<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()
            ->count(5)
            ->has(Position::factory()->count(5), 'positions')
            ->create()
        ;

        $this->createTieredDepartment('Human Resource');
        $this->createTieredDepartment('Finance');
        $this->createExecutiveDepartment();
    }

    protected function createTieredDepartment(string $name): void
    {
        $department = Department::firstOrCreate([
            'name' => $name,
        ]);

        $positions = [
            new Position([
                'department_id' => $department->id,
                'name' => 'Manager',
                'level' => 100,
            ]),
            new Position([
                'department_id' => $department->id,
                'name' => 'Supervisor',
                'level' => 50,
            ]),
            new Position([
                'department_id' => $department->id,
                'name' => 'Staff',
                'level' => 10,
            ]),
        ];

        $department->positions->each->delete();
        $department->positions()->saveMany($positions);
    }

    protected function createExecutiveDepartment(): void
    {
        $department = Department::firstOrCreate([
            'name' => 'Executive',
        ]);

        $positions = [
            new Position([
                'department_id' => $department->id,
                'name' => 'Managing Director',
                'level' => 10000,
            ]),
            new Position([
                'department_id' => $department->id,
                'name' => 'Vice Managing Director',
                'level' => 1000,
            ]),
        ];

        $department->positions->each->delete();
        $department->positions()->saveMany($positions);
    }
}
