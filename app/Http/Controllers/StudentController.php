<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Department;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with([
            'department',
            'program',
            'academicYear'
        ])
            ->latest()
            ->paginate(10);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        $departments = Department::where('status', true)
            ->orderBy('name')
            ->get();

        $programs = Program::where('status', true)
            ->orderBy('name')
            ->get();

        $academicYears = AcademicYear::orderByDesc('start_date')
            ->get();

        return view('students.create', compact(
            'departments',
            'programs',
            'academicYears'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'string',
                'max:30',
                'unique:students,student_id',
            ],

            'first_name' => [
                'required',
                'string',
                'max:255',
            ],

            'middle_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'last_name' => [
                'required',
                'string',
                'max:255',
            ],

            'gender' => [
                'required',
                Rule::in(['Male', 'Female']),
            ],

            'date_of_birth' => [
                'nullable',
                'date',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:students,email',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'program_id' => [
                'required',
                'exists:programs,id',
            ],

            'academic_year_id' => [
                'required',
                'exists:academic_years,id',
            ],

            'admission_type' => [
                'required',
                'string',
                'max:30',
            ],

            'status' => [
                'required',
                Rule::in([
                    'Active',
                    'Inactive',
                    'Graduated',
                    'Withdrawn'
                ]),
            ],
        ]);

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load([
            'department',
            'program',
            'academicYear'
        ]);

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $departments = Department::where('status', true)
            ->orderBy('name')
            ->get();

        $programs = Program::where('status', true)
            ->orderBy('name')
            ->get();

        $academicYears = AcademicYear::orderByDesc('start_date')
            ->get();

        return view('students.edit', compact(
            'student',
            'departments',
            'programs',
            'academicYears'
        ));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'string',
                'max:30',
                Rule::unique('students', 'student_id')
                    ->ignore($student->id),
            ],

            'first_name' => [
                'required',
                'string',
                'max:255',
            ],

            'middle_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'last_name' => [
                'required',
                'string',
                'max:255',
            ],

            'gender' => [
                'required',
                Rule::in(['Male', 'Female']),
            ],

            'date_of_birth' => [
                'nullable',
                'date',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('students', 'email')
                    ->ignore($student->id),
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'program_id' => [
                'required',
                'exists:programs,id',
            ],

            'academic_year_id' => [
                'required',
                'exists:academic_years,id',
            ],

            'admission_type' => [
                'required',
                'string',
                'max:30',
            ],

            'status' => [
                'required',
                Rule::in([
                    'Active',
                    'Inactive',
                    'Graduated',
                    'Withdrawn'
                ]),
            ],
        ]);

        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}