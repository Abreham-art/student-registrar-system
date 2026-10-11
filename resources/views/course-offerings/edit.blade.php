<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course Offering - Registrar System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 850px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
            color: #1f2937;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #374151;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }

        .buttons {
            margin-top: 25px;
        }

        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }

        .update {
            background: #2563eb;
        }

        .back {
            background: #6b7280;
            margin-left: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Course Offering</h1>

    <form
        action="{{ route('course-offerings.update', $courseOffering) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="course_id">Course</label>

            <select name="course_id" id="course_id" required>
                <option value="">-- Select Course --</option>

                @foreach($courses as $course)
                    <option
                        value="{{ $course->id }}"
                        {{ old('course_id', $courseOffering->course_id) == $course->id ? 'selected' : '' }}
                    >
                        {{ $course->code }} - {{ $course->name }}
                    </option>
                @endforeach
            </select>

            @error('course_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="semester_id">Semester</label>

            <select name="semester_id" id="semester_id" required>
                <option value="">-- Select Semester --</option>

                @foreach($semesters as $semester)
                    <option
                        value="{{ $semester->id }}"
                        {{ old('semester_id', $courseOffering->semester_id) == $semester->id ? 'selected' : '' }}
                    >
                        {{ $semester->academicYear->name ?? 'N/A' }}
                        -
                        {{ $semester->semester_number }}
                        -
                        {{ $semester->name }}
                    </option>
                @endforeach
            </select>

            @error('semester_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="instructor_name">Instructor Name</label>

            <input
                type="text"
                name="instructor_name"
                id="instructor_name"
                value="{{ old('instructor_name', $courseOffering->instructor_name) }}"
            >

            @error('instructor_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="capacity">Capacity</label>

            <input
                type="number"
                name="capacity"
                id="capacity"
                value="{{ old('capacity', $courseOffering->capacity) }}"
                min="1"
                max="1000"
                required
            >

            @error('capacity')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="room">Room</label>

            <input
                type="text"
                name="room"
                id="room"
                value="{{ old('room', $courseOffering->room) }}"
            >

            @error('room')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="schedule">Schedule</label>

            <input
                type="text"
                name="schedule"
                id="schedule"
                value="{{ old('schedule', $courseOffering->schedule) }}"
            >

            @error('schedule')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>

            <select name="status" id="status" required>
                <option
                    value="1"
                    {{ old('status', $courseOffering->status ? '1' : '0') == '1' ? 'selected' : '' }}
                >
                    Active
                </option>

                <option
                    value="0"
                    {{ old('status', $courseOffering->status ? '1' : '0') == '0' ? 'selected' : '' }}
                >
                    Inactive
                </option>
            </select>

            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="buttons">

            <button type="submit" class="btn update">
                Update Course Offering
            </button>

            <a
                href="{{ route('course-offerings.index') }}"
                class="btn back"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

</body>
</html>