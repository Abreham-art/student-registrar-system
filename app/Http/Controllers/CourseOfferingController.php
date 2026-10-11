<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseOffering;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseOfferingController extends Controller
{
    public function index()
    {
        $courseOfferings = CourseOffering::with([
            'course',
            'semester.academicYear'
        ])
            ->latest()
            ->paginate(10);

        return view('course-offerings.index', compact('courseOfferings'));
    }

    public function create()
    {
        $courses = Course::where('status', true)
            ->orderBy('code')
            ->get();

        $semesters = Semester::with('academicYear')
            ->orderByDesc('start_date')
            ->get();

        return view('course-offerings.create', compact(
            'courses',
            'semesters'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => [
                'required',
                'exists:courses,id',
            ],

            'semester_id' => [
                'required',
                'exists:semesters,id',
            ],

            'instructor_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'capacity' => [
                'required',
                'integer',
                'min:1',
                'max:1000',
            ],

            'room' => [
                'nullable',
                'string',
                'max:100',
            ],

            'schedule' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        $exists = CourseOffering::where('course_id', $validated['course_id'])
            ->where('semester_id', $validated['semester_id'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_id' => 'This course is already offered in the selected semester.'
                ]);
        }

        CourseOffering::create($validated);

        return redirect()
            ->route('course-offerings.index')
            ->with('success', 'Course offering created successfully.');
    }

    public function show(CourseOffering $courseOffering)
    {
        $courseOffering->load([
            'course',
            'semester.academicYear'
        ]);

        return view(
            'course-offerings.show',
            compact('courseOffering')
        );
    }

    public function edit(CourseOffering $courseOffering)
    {
        $courses = Course::where('status', true)
            ->orderBy('code')
            ->get();

        $semesters = Semester::with('academicYear')
            ->orderByDesc('start_date')
            ->get();

        return view('course-offerings.edit', compact(
            'courseOffering',
            'courses',
            'semesters'
        ));
    }

    public function update(
        Request $request,
        CourseOffering $courseOffering
    ) {
        $validated = $request->validate([
            'course_id' => [
                'required',
                'exists:courses,id',
            ],

            'semester_id' => [
                'required',
                'exists:semesters,id',
            ],

            'instructor_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'capacity' => [
                'required',
                'integer',
                'min:1',
                'max:1000',
            ],

            'room' => [
                'nullable',
                'string',
                'max:100',
            ],

            'schedule' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        $exists = CourseOffering::where('course_id', $validated['course_id'])
            ->where('semester_id', $validated['semester_id'])
            ->where('id', '!=', $courseOffering->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_id' => 'This course is already offered in the selected semester.'
                ]);
        }

        $courseOffering->update($validated);

        return redirect()
            ->route('course-offerings.index')
            ->with('success', 'Course offering updated successfully.');
    }

    public function destroy(CourseOffering $courseOffering)
    {
        $courseOffering->delete();

        return redirect()
            ->route('course-offerings.index')
            ->with('success', 'Course offering deleted successfully.');
    }
}