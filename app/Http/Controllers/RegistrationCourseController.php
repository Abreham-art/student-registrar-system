<?php

namespace App\Http\Controllers;

use App\Models\CourseOffering;
use App\Models\Registration;
use App\Models\RegistrationCourse;
use Illuminate\Http\Request;

class RegistrationCourseController extends Controller
{
    public function index()
    {
        $registrationCourses = RegistrationCourse::with([
            'registration.student',
            'registration.semester.academicYear',
            'courseOffering.course',
            'courseOffering.semester'
        ])
            ->latest()
            ->paginate(10);

        return view(
            'registration-courses.index',
            compact('registrationCourses')
        );
    }

    public function create()
    {
        $registrations = Registration::with([
            'student',
            'semester.academicYear'
        ])
            ->where('status', 'Registered')
            ->latest()
            ->get();

        $courseOfferings = CourseOffering::with([
            'course',
            'semester.academicYear'
        ])
            ->where('status', true)
            ->latest()
            ->get();

        return view(
            'registration-courses.create',
            compact(
                'registrations',
                'courseOfferings'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_id' => [
                'required',
                'exists:registrations,id',
            ],
            'course_offering_id' => [
                'required',
                'exists:course_offerings,id',
            ],
            'status' => [
                'required',
                'in:Registered,Dropped,Completed',
            ],
        ]);

        $registration = Registration::findOrFail(
            $validated['registration_id']
        );

        $courseOffering = CourseOffering::findOrFail(
            $validated['course_offering_id']
        );

        if ($registration->semester_id !== $courseOffering->semester_id) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_offering_id' =>
                        'The selected course does not belong to the student registration semester.'
                ]);
        }

        $exists = RegistrationCourse::where(
            'registration_id',
            $validated['registration_id']
        )
            ->where(
                'course_offering_id',
                $validated['course_offering_id']
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_offering_id' =>
                        'This course is already added to the registration.'
                ]);
        }

        RegistrationCourse::create($validated);

        return redirect()
            ->route('registration-courses.index')
            ->with(
                'success',
                'Course added to registration successfully.'
            );
    }

    public function show(RegistrationCourse $registrationCourse)
    {
        $registrationCourse->load([
            'registration.student.department',
            'registration.student.program',
            'registration.semester.academicYear',
            'courseOffering.course',
            'courseOffering.semester.academicYear'
        ]);

        return view(
            'registration-courses.show',
            compact('registrationCourse')
        );
    }

    public function edit(RegistrationCourse $registrationCourse)
    {
        $registrations = Registration::with([
            'student',
            'semester.academicYear'
        ])
            ->where('status', 'Registered')
            ->latest()
            ->get();

        $courseOfferings = CourseOffering::with([
            'course',
            'semester.academicYear'
        ])
            ->where('status', true)
            ->latest()
            ->get();

        return view(
            'registration-courses.edit',
            compact(
                'registrationCourse',
                'registrations',
                'courseOfferings'
            )
        );
    }

    public function update(
        Request $request,
        RegistrationCourse $registrationCourse
    ) {
        $validated = $request->validate([
            'registration_id' => [
                'required',
                'exists:registrations,id',
            ],
            'course_offering_id' => [
                'required',
                'exists:course_offerings,id',
            ],
            'status' => [
                'required',
                'in:Registered,Dropped,Completed',
            ],
        ]);

        $registration = Registration::findOrFail(
            $validated['registration_id']
        );

        $courseOffering = CourseOffering::findOrFail(
            $validated['course_offering_id']
        );

        if ($registration->semester_id !== $courseOffering->semester_id) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_offering_id' =>
                        'The selected course does not belong to the student registration semester.'
                ]);
        }

        $exists = RegistrationCourse::where(
            'registration_id',
            $validated['registration_id']
        )
            ->where(
                'course_offering_id',
                $validated['course_offering_id']
            )
            ->where(
                'id',
                '!=',
                $registrationCourse->id
            )
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_offering_id' =>
                        'This course is already added to the registration.'
                ]);
        }

        $registrationCourse->update($validated);

        return redirect()
            ->route('registration-courses.index')
            ->with(
                'success',
                'Registration course updated successfully.'
            );
    }

    public function destroy(RegistrationCourse $registrationCourse)
    {
        $registrationCourse->delete();

        return redirect()
            ->route('registration-courses.index')
            ->with(
                'success',
                'Course removed from registration successfully.'
            );
    }
}