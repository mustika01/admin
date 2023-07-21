<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use function Termwind\render;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::with('department')->get();

        return Inertia::render(
            'Positions/List',
            ['positions' => $positions]
        );
    }

    public function create()
    {
        $position = Position::all();
        $allDepartments = Department::all();
        return Inertia::render('Positions/Create', [
            'position' => $position,
            'allDepartments' => $allDepartments,

        ]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
        ])->validate();

        Position::create($request->all());

        return redirect('positions');
    }

    public function show(Position $position)
    {
        $allDepartments = Department::all();
        return Inertia::render(
            'Positions/View',
            [
                'position' => $position,
                'allDepartments' => $allDepartments,
            ]
        );
    }

    public function edit(Position $position)
    {
        $allDepartments = Department::all();
        return Inertia::render('Positions/Edit', [
            'position' => $position,
            'allDepartments' => $allDepartments,
        ]);

    }
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name'=> 'required',
        ]);

        $position->name = $request->name;
        $position->level = $request->level;
        $position->summary = $request->summary;
        $position->department_id = $request->department_id;
        $position->save();

        return redirect()->route('positions.index');

    }
    public function destroy(Position $position)
    {
        $position->delete();
        // sleep(1);
        return redirect(route('positions.index'));
    }
}
