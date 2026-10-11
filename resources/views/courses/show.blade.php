<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        .row {
            padding: 15px 0;
            border-bottom: 1px solid #ddd;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 180px;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 16px;
            background: #6b7280;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .edit {
            background: #f59e0b;
            margin-left: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Course Details</h1>

    <div class="row">
        <span class="label">Course Code:</span>
        {{ $course->code }}
    </div>

    <div class="row">
        <span class="label">Course Name:</span>
        {{ $course->name }}
    </div>

    <div class="row">
        <span class="label">Department:</span>
        {{ $course->department->name }}
    </div>

    <div class="row">
        <span class="label">Credit Hours:</span>
        {{ $course->credit_hours }}
    </div>

    <div class="row">
        <span class="label">Course Type:</span>
        {{ $course->course_type }}
    </div>

    <div class="row">
        <span class="label">Description:</span>
        {{ $course->description ?: 'No description' }}
    </div>

    <div class="row">
        <span class="label">Status:</span>

        @if($course->status)
            <span style="color:green;">Active</span>
        @else
            <span style="color:red;">Inactive</span>
        @endif
    </div>

    <a href="{{ route('courses.index') }}">
        ← Back to Courses
    </a>

    <a href="{{ route('courses.edit', $course) }}" class="edit">
        Edit Course
    </a>

</div>

</body>
</html>