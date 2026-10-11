<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::with('academicYear')
            ->latest()
            ->paginate(10);

        return view('semesters.index', compact('semesters'));
    }

    public function create()
    {
        $academicYears = AcademicYear::orderByDesc('start_date')
            ->get();

        return view('semesters.create', compact('academicYears'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year_id' => [
                'required',
                'exists:academic_years,id',
            ],
            'name' => [
                'required',
                'string',
                'max:30',
            ],
            'semester_number' => [
                'required',
                Rule::in([
                    'Semester 1',
                    'Semester 2',
                    'Summer',
                ]),
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
            ],
            'status' => [
                'required',
                'boolean',
            ],
        ]);

        Semester::create($validated);

        return redirect()
            ->route('semesters.index')
            ->with('success', 'Semester created successfully.');
    }

    public function show(Semester $semester)
    {
        $semester->load('academicYear');

        return view('semesters.show', compact('semester'));
    }

    public function edit(Semester $semester)
    {
        $academicYears = AcademicYear::orderByDesc('start_date')
            ->get();

        return view('semesters.edit', compact(
            'semester',
            'academicYears'
        ));
    }

    public function update(Request $request, Semester $semester)
    {
        $validated = $request->validate([
            'academic_year_id' => [
                'required',
                'exists:academic_years,id',
            ],
            'name' => [
                'required',
                'string',
                'max:30',
            ],
            'semester_number' => [
                'required',
                Rule::in([
                    'Semester 1',
                    'Semester 2',
                    'Summer',
                ]),
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
            ],
            'status' => [
                'required',
                'boolean',
            ],
        ]);

        Semester::where('id', $semester->id)
            ->update($validated);

        return redirect()
            ->route('semesters.index')
            ->with('success', 'Semester updated successfully.');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();

        return redirect()
            ->route('semesters.index')
            ->with('success', 'Semester deleted successfully.');
    }
}