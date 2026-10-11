<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('department')
            ->latest()
            ->paginate(10);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $departments = Department::where('status', true)
            ->orderBy('name')
            ->get();

        return view('courses.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'code' => ['required', 'string', 'max:30', 'unique:courses,code'],
            'name' => ['required', 'string', 'max:255'],
            'credit_hours' => ['required', 'integer', 'min:1', 'max:20'],
            'course_type' => [
                'required',
                Rule::in(['Core', 'Elective', 'Practical']),
            ],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        Course::create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        $course->load('department');

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $departments = Department::where('status', true)
            ->orderBy('name')
            ->get();

        return view('courses.edit', compact('course', 'departments'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('courses', 'code')->ignore($course->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'credit_hours' => ['required', 'integer', 'min:1', 'max:20'],
            'course_type' => [
                'required',
                Rule::in(['Core', 'Elective', 'Practical']),
            ],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        $course->update($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}