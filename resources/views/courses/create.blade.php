<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .error {
            color: #dc2626;
            margin-top: 5px;
            font-size: 14px;
        }

        .buttons {
            margin-top: 25px;
        }

        button,
        a {
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

    <h1>Add Course</h1>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="department_id">Department</label>

            <select name="department_id" id="department_id" required>
                <option value="">-- Select Department --</option>

                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
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
                value="{{ old('code') }}"
                placeholder="e.g. CS101"
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
                value="{{ old('name') }}"
                placeholder="e.g. Introduction to Computer Science"
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
                value="{{ old('credit_hours') }}"
                min="1"
                max="20"
                placeholder="e.g. 3"
                required
            >

            @error('credit_hours')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="course_type">Course Type</label>

            <select name="course_type" id="course_type" required>
                <option value="">-- Select Type --</option>

                <option value="Core"
                    {{ old('course_type') == 'Core' ? 'selected' : '' }}>
                    Core
                </option>

                <option value="Elective"
                    {{ old('course_type') == 'Elective' ? 'selected' : '' }}>
                    Elective
                </option>

                <option value="Practical"
                    {{ old('course_type') == 'Practical' ? 'selected' : '' }}>
                    Practical
                </option>
            </select>

            @error('course_type')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>

            <textarea
                name="description"
                id="description"
                placeholder="Course description..."
            >{{ old('description') }}</textarea>

            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>

            <select name="status" id="status" required>
                <option value="1"
                    {{ old('status', '1') == '1' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('status') === '0' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>

            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="buttons">
            <button type="submit" class="save">
                Save Course
            </button>

            <a href="{{ route('courses.index') }}" class="cancel">
                Cancel
            </a>
        </div>

    </form>

</div>

</body>
</html>