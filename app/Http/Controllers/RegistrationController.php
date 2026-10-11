<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Student;
use App\Models\Semester;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::with([
            'student',
            'semester.academicYear'
        ])
            ->latest()
            ->paginate(10);

        return view('registrations.index', compact('registrations'));
    }

    public function create()
    {
        $students = Student::where('status', 'Active')
            ->orderBy('student_id')
            ->get();

        $semesters = Semester::with('academicYear')
            ->orderByDesc('start_date')
            ->get();

        return view('registrations.create', compact(
            'students',
            'semesters'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'exists:students,id',
            ],
            'semester_id' => [
                'required',
                'exists:semesters,id',
            ],
            'registration_date' => [
                'required',
                'date',
            ],
            'status' => [
                'required',
                'in:Pending,Registered,Dropped,Cancelled',
            ],
            'remarks' => [
                'nullable',
                'string',
            ],
        ]);

        $exists = Registration::where(
            'student_id',
            $validated['student_id']
        )
            ->where(
                'semester_id',
                $validated['semester_id']
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'This student is already registered for the selected semester.'
                ]);
        }

        Registration::create($validated);

        return redirect()
            ->route('registrations.index')
            ->with(
                'success',
                'Registration created successfully.'
            );
    }

    public function show(Registration $registration)
    {
        $registration->load([
            'student.department',
            'student.program',
            'semester.academicYear'
        ]);

        return view(
            'registrations.show',
            compact('registration')
        );
    }

    public function edit(Registration $registration)
    {
        $students = Student::where('status', 'Active')
            ->orderBy('student_id')
            ->get();

        $semesters = Semester::with('academicYear')
            ->orderByDesc('start_date')
            ->get();

        return view(
            'registrations.edit',
            compact(
                'registration',
                'students',
                'semesters'
            )
        );
    }

    public function update(
        Request $request,
        Registration $registration
    ) {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'exists:students,id',
            ],
            'semester_id' => [
                'required',
                'exists:semesters,id',
            ],
            'registration_date' => [
                'required',
                'date',
            ],
            'status' => [
                'required',
                'in:Pending,Registered,Dropped,Cancelled',
            ],
            'remarks' => [
                'nullable',
                'string',
            ],
        ]);

        $exists = Registration::where(
            'student_id',
            $validated['student_id']
        )
            ->where(
                'semester_id',
                $validated['semester_id']
            )
            ->where(
                'id',
                '!=',
                $registration->id
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'This student is already registered for the selected semester.'
                ]);
        }

        $registration->update($validated);

        return redirect()
            ->route('registrations.index')
            ->with(
                'success',
                'Registration updated successfully.'
            );
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return redirect()
            ->route('registrations.index')
            ->with(
                'success',
                'Registration deleted successfully.'
            );
    }
}