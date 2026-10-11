<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>

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

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            min-height: 100px;
        }

        .error {
            color: red;
            margin-top: 5px;
        }

        button, a {
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .save {
            background: #2563eb;
            color: white;
        }

        .cancel {
            background: #6b7280;
            color: white;
            margin-left: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Course</h1>

    <form action="{{ route('courses.update', $course) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="department_id">Department</label>

            <select name="department_id" id="department_id" required>

                @foreach($departments as $department)

                    <option value="{{ $department->id }}"
                        {{ old('department_id', $course->department_id) == $department->id ? 'selected' : '' }}>

                        {{ $department->code }} - {{ $department->name }}

                    </option>

                @endforeach

            </select>

            @error('department_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="code">Course Code</label>

            <input
                type="text"
                name="code"
                id="code"
                value="{{ old('code', $course->code) }}"
                required
            >

            @error('code')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Course Name</label>

            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $course->name) }}"
                required
            >

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="credit_hours">Credit Hours</label>

            <input
                type="number"
                name="credit_hours"
                id="credit_hours"
                value="{{ old('credit_hours', $course->credit_hours) }}"
                min="1"
                max="20"
                required
            >

            @error('credit_hours')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="course_type">Course Type</label>

            <select name="course_type" id="course_type" required>

                <option value="Core"
                    {{ old('course_type', $course->course_type) == 'Core' ? 'selected' : '' }}>
                    Core
                </option>

                <option value="Elective"
                    {{ old('course_type', $course->course_type) == 'Elective' ? 'selected' : '' }}>
                    Elective
                </option>

                <option value="Practical"
                    {{ old('course_type', $course->course_type) == 'Practical' ? 'selected' : '' }}>
                    Practical
                </option>

            </select>

            @error('course_type')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>

            <textarea name="description" id="description">{{ old('description', $course->description) }}</textarea>

            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>

            <select name="status" id="status" required>

                <option value="1"
                    {{ old('status', $course->status ? '1' : '0') == '1' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('status', $course->status ? '1' : '0') == '0' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="save">
            Update Course
        </button>

        <a href="{{ route('courses.index') }}" class="cancel">
            Cancel
        </a>

    </form>

</div>

</body>
</html>