<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('parent', 'manager')->withCount('employees')->get();
        $employees = Employee::all();

        return Inertia::render(
            'Departments/Kanban',
            [
                'departments' => $departments,
                'employees' => $employees,
                ]
        );
    }

    public function create()
    {
        $department = Department::all();
        $employees = Employee::all();
        $allDepartments = Department::all();
        return Inertia::render('Departments/Create', [
            'department' => $department,
            'employees' => $employees,
            'allDepartments' => $allDepartments,
        ]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();

        Department::create($request->all());

        return redirect('departments');
    }

    public function show(Department $department)
    {
        $employees = Employee::all();
        $allDepartments = Department::query()->where('id', '!=', $department->id)->get();

        return Inertia::render('Departments/View', [
            'department' => $department,
            'employees' => $employees,
            'allDepartments' => $allDepartments,
        ]);
    }

    public function edit(Department $department)
    {
        $employees = Employee::all();
        $allDepartments = Department::query()->where('id', '!=', $department->id)->get();

        return Inertia::render('Departments/Edit', [
            'department' => $department,
            'employees' => $employees,
            'allDepartments' => $allDepartments,
        ]);
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $department->name = $request->name;
        $department->manager_id = $request->manager_id;
        $department->parent_id = $request->parent_id;
        $department->save();
        sleep(1);

        return redirect()->route('departments.index');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        sleep(1);

        return redirect()->route('departments.index');
    }
}
