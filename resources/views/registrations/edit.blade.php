<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Registration - Registrar System</title>

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
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
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
            display: inline-block;
            padding: 11px 18px;
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            text-decoration: none;
            margin-right: 8px;
        }

        .update {
            background: #f59e0b;
        }

        .back {
            background: #6b7280;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Registration</h1>

    @if ($errors->any())
        <div style="background:#fee2e2; padding:15px; border-radius:6px; margin-bottom:20px;">
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('registrations.update', $registration) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="form-group">

            <label for="student_id">
                Student
            </label>

            <select
                name="student_id"
                id="student_id"
                required
            >

                <option value="">
                    -- Select Student --
                </option>

                @foreach ($students as $student)

                    <option
                        value="{{ $student->id }}"
                        {{ old('student_id', $registration->student_id) == $student->id ? 'selected' : '' }}
                    >
                        {{ $student->student_id }}
                        -
                        {{ $student->first_name }}
                        {{ $student->middle_name }}
                        {{ $student->last_name }}
                    </option>

                @endforeach

            </select>

            @error('student_id')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>


        <div class="form-group">

            <label for="semester_id">
                Semester
            </label>

            <select
                name="semester_id"
                id="semester_id"
                required
            >

                <option value="">
                    -- Select Semester --
                </option>

                @foreach ($semesters as $semester)

                    <option
                        value="{{ $semester->id }}"
                        {{ old('semester_id', $registration->semester_id) == $semester->id ? 'selected' : '' }}
                    >
                        {{ $semester->academicYear->name ?? 'N/A' }}
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

            <label for="registration_date">
                Registration Date
            </label>

            <input
                type="date"
                name="registration_date"
                id="registration_date"
                value="{{ old('registration_date', $registration->registration_date?->format('Y-m-d')) }}"
                required
            >

            @error('registration_date')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>


        <div class="form-group">

            <label for="status">
                Status
            </label>

            <select
                name="status"
                id="status"
                required
            >

                <option
                    value="Pending"
                    {{ old('status', $registration->status) == 'Pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="Registered"
                    {{ old('status', $registration->status) == 'Registered' ? 'selected' : '' }}
                >
                    Registered
                </option>

                <option
                    value="Dropped"
                    {{ old('status', $registration->status) == 'Dropped' ? 'selected' : '' }}
                >
                    Dropped
                </option>

                <option
                    value="Cancelled"
                    {{ old('status', $registration->status) == 'Cancelled' ? 'selected' : '' }}
                >
                    Cancelled
                </option>

            </select>

            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>


        <div class="form-group">

            <label for="remarks">
                Remarks
            </label>

            <textarea
                name="remarks"
                id="remarks"
                placeholder="Optional remarks..."
            >{{ old('remarks', $registration->remarks) }}</textarea>

            @error('remarks')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>


        <div class="buttons">

            <button
                type="submit"
                class="btn update"
            >
                Update Registration
            </button>

            <a
                href="{{ route('registrations.index') }}"
                class="btn back"
            >
                Back
            </a>

        </div>

    </form>

</div>

</body>
</html>