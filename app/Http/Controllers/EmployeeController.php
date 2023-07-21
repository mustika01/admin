<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department', 'position', 'manager')->get();
        $positions = Position::all();

        return Inertia::render(
            'Employees/Kanban',
            [
                'employees' => $employees,
                'positions' => $positions,
                ]
        );
    }

    public function show(Employee $employee)
    {
        $allEmployees = Employee::all();
        $departments = Department::all();
        $positions = Position::all();
        return Inertia::render('Employees/View', [
            'employee' => $employee,
            'allEmployees' => $allEmployees,
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }

    public function create()
    {
        $allEmployees = Employee::all();
        $departments = Department::all();
        $positions = Position::all();
        return Inertia::render('Employees/Create', [
            'allEmployees' => $allEmployees,
            'departments' => $departments,
            'positions' => $positions,

        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'tag' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'mobile' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'manager_id' => 'nullable',
            'coach_id' => 'nullable',
        ]);

        // dd($validated);
        Employee::create($validated);

        return redirect('employees');
    }

    public function edit(Employee $employee)
    {
        $allEmployees = Employee::all();
        $departments = Department::all();
        $positions = Position::all();
        return Inertia::render('Employees/Edit', [
            'employee' => $employee,
            'allEmployees' => $allEmployees,
            'departments' => $departments,
            'positions' => $positions,
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'tag' => 'required',
        ]);

        $employee->name = $request->name;
        $employee->tag = $request->tag;
        $employee->mobile = $request->mobile;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->department_id = $request->department_id;
        $employee->position_id = $request->position_id;
        $employee->manager_id = $request->manager_id;
        $employee->coach_id = $request->coach_id;
        $employee->save();

        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect(route('employees.index'));

    }

    public function filterJobPosition(Request $request)
    {
        $departmentID = $request->get('department_id', 0);

        $positions = Position::query()
            ->where('department_id', $departmentID)
            ->get();

        return $positions;
    }
}
