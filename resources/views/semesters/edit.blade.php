<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Semester - Registrar System</title>

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

    <h1>Edit Semester</h1>

    <form
        action="{{ route('semesters.update', $semester) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="academic_year_id">
                Academic Year
            </label>

            <select name="academic_year_id" id="academic_year_id" required>
                <option value="">-- Select Academic Year --</option>

                @foreach($academicYears as $academicYear)
                    <option
                        value="{{ $academicYear->id }}"
                        {{ old('academic_year_id', $semester->academic_year_id) == $academicYear->id ? 'selected' : '' }}
                    >
                        {{ $academicYear->name }}
                    </option>
                @endforeach
            </select>

            @error('academic_year_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="semester_number">
                Semester
            </label>

            <select name="semester_number" id="semester_number" required>

                <option value="">-- Select Semester --</option>

                <option
                    value="Semester 1"
                    {{ old('semester_number', $semester->semester_number) == 'Semester 1' ? 'selected' : '' }}
                >
                    Semester 1
                </option>

                <option
                    value="Semester 2"
                    {{ old('semester_number', $semester->semester_number) == 'Semester 2' ? 'selected' : '' }}
                >
                    Semester 2
                </option>

                <option
                    value="Summer"
                    {{ old('semester_number', $semester->semester_number) == 'Summer' ? 'selected' : '' }}
                >
                    Summer
                </option>

            </select>

            @error('semester_number')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">
                Semester Name
            </label>

            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $semester->name) }}"
                required
            >

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="start_date">
                Start Date
            </label>

            <input
                type="date"
                name="start_date"
                id="start_date"
                value="{{ old('start_date', $semester->start_date?->format('Y-m-d')) }}"
                required
            >

            @error('start_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="end_date">
                End Date
            </label>

            <input
                type="date"
                name="end_date"
                id="end_date"
                value="{{ old('end_date', $semester->end_date?->format('Y-m-d')) }}"
                required
            >

            @error('end_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">
                Status
            </label>

            <select name="status" id="status" required>

                <option
                    value="1"
                    {{ old('status', $semester->status ? '1' : '0') == '1' ? 'selected' : '' }}
                >
                    Active
                </option>

                <option
                    value="0"
                    {{ old('status', $semester->status ? '1' : '0') == '0' ? 'selected' : '' }}
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
                Update Semester
            </button>

            <a
                href="{{ route('semesters.index') }}"
                class="btn back"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

</body>
</html>
