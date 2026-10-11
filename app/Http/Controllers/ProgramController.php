<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('department')
            ->latest()
            ->paginate(10);

        return view('programs.index', compact('programs'));
    }

    public function create()
{
    $departments = Department::where('status', true)
        ->orderBy('name')
        ->get();

    return view('programs.create', compact('departments'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'code' => ['required', 'string', 'max:30', 'unique:programs,code'],
            'name' => ['required', 'string', 'max:255'],
            'degree_type' => [
                'required',
                Rule::in(['Diploma', 'Bachelor', 'Master', 'PhD']),
            ],
            'duration_years' => ['required', 'integer', 'min:1', 'max:10'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        Program::create($validated);

        return redirect()
            ->route('programs.index')
            ->with('success', 'Program created successfully.');
    }

    public function show(Program $program)
    {
        $program->load('department');

        return view('programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        $departments = Department::where('status', true)
            ->orderBy('name')
            ->get();

        return view('programs.edit', compact('program', 'departments'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('programs', 'code')->ignore($program->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'degree_type' => [
                'required',
                Rule::in(['Diploma', 'Bachelor', 'Master', 'PhD']),
            ],
            'duration_years' => ['required', 'integer', 'min:1', 'max:10'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        $program->update($validated);

        return redirect()
            ->route('programs.index')
            ->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()
            ->route('programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}