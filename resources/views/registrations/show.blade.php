<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration Details - Registrar System</title>

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

        .row {
            padding: 14px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .label {
            display: inline-block;
            width: 180px;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            margin-top: 25px;
            margin-right: 8px;
        }

        .edit {
            background: #f59e0b;
        }

        .back {
            background: #6b7280;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Registration Details</h1>

    <div class="row">
        <span class="label">Student ID:</span>
        {{ $registration->student->student_id ?? 'N/A' }}
    </div>

    <div class="row">
        <span class="label">Student Name:</span>
        {{ $registration->student->first_name ?? '' }}
        {{ $registration->student->middle_name ?? '' }}
        {{ $registration->student->last_name ?? '' }}
    </div>

    <div class="row">
        <span class="label">Department:</span>
        {{ $registration->student->department->name ?? 'N/A' }}
    </div>

    <div class="row">
        <span class="label">Program:</span>
        {{ $registration->student->program->name ?? 'N/A' }}
    </div>

    <div class="row">
        <span class="label">Academic Year:</span>
        {{ $registration->semester->academicYear->name ?? 'N/A' }}
    </div>

    <div class="row">
        <span class="label">Semester:</span>
        {{ $registration->semester->name ?? 'N/A' }}
    </div>

    <div class="row">
        <span class="label">Registration Date:</span>
        {{ $registration->registration_date?->format('Y-m-d') ?? 'N/A' }}
    </div>

    <div class="row">
        <span class="label">Status:</span>
        {{ $registration->status }}
    </div>

    <div class="row">
        <span class="label">Remarks:</span>
        {{ $registration->remarks ?? 'No remarks' }}
    </div>

    <a
        href="{{ route('registrations.edit', $registration) }}"
        class="btn edit"
    >
        Edit
    </a>

    <a
        href="{{ route('registrations.index') }}"
        class="btn back"
    >
        Back to Registrations
    </a>

</div>

</body>
</html>