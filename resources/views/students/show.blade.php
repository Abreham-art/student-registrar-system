<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            color: #1f2937;
        }

        .student-id {
            font-size: 20px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 25px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .item {
            padding: 15px;
            background: #f9fafb;
            border-radius: 6px;
        }

        .label {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .value {
            font-size: 16px;
            font-weight: bold;
            color: #111827;
        }

        .buttons {
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            margin-right: 8px;
        }

        .edit {
            background: #ca8a04;
        }

        .back {
            background: #6b7280;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Student Details</h1>

    <div class="student-id">
        {{ $student->student_id }}
    </div>

    <div class="grid">

        <div class="item">
            <div class="label">Full Name</div>
            <div class="value">
                {{ $student->first_name }}
                {{ $student->middle_name }}
                {{ $student->last_name }}
            </div>
        </div>

        <div class="item">
            <div class="label">Gender</div>
            <div class="value">
                {{ $student->gender }}
            </div>
        </div>

        <div class="item">
            <div class="label">Date of Birth</div>
            <div class="value">
                {{ $student->date_of_birth?->format('d M Y') ?? 'N/A' }}
            </div>
        </div>

        <div class="item">
            <div class="label">Phone</div>
            <div class="value">
                {{ $student->phone ?? 'N/A' }}
            </div>
        </div>

        <div class="item">
            <div class="label">Email</div>
            <div class="value">
                {{ $student->email ?? 'N/A' }}
            </div>
        </div>

        <div class="item">
            <div class="label">Department</div>
            <div class="value">
                {{ $student->department->name ?? 'N/A' }}
            </div>
        </div>

        <div class="item">
            <div class="label">Program</div>
            <div class="value">
                {{ $student->program->name ?? 'N/A' }}
            </div>
        </div>

        <div class="item">
            <div class="label">Academic Year</div>
            <div class="value">
                {{ $student->academicYear->name ?? 'N/A' }}
            </div>
        </div>

        <div class="item">
            <div class="label">Admission Type</div>
            <div class="value">
                {{ $student->admission_type }}
            </div>
        </div>

        <div class="item">
            <div class="label">Status</div>
            <div class="value">
                {{ $student->status }}
            </div>
        </div>

    </div>

    <div class="buttons">

        <a
            href="{{ route('students.edit', $student) }}"
            class="btn edit">
            Edit Student
        </a>

        <a
            href="{{ route('students.index') }}"
            class="btn back">
            Back to Students
        </a>

    </div>

</div>

</body>
</html>