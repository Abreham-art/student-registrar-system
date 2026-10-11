<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semester Details - Registrar System</title>

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

        .row {
            padding: 14px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .label {
            font-weight: bold;
            color: #374151;
            display: inline-block;
            width: 180px;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .buttons {
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
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

    <h1>Semester Details</h1>

    <div class="row">
        <span class="label">Academic Year:</span>
        {{ $semester->academicYear->name ?? 'N/A' }}
    </div>

    <div class="row">
        <span class="label">Semester:</span>
        {{ $semester->semester_number }}
    </div>

    <div class="row">
        <span class="label">Name:</span>
        {{ $semester->name }}
    </div>

    <div class="row">
        <span class="label">Start Date:</span>
        {{ $semester->start_date?->format('Y-m-d') }}
    </div>

    <div class="row">
        <span class="label">End Date:</span>
        {{ $semester->end_date?->format('Y-m-d') }}
    </div>

    <div class="row">
        <span class="label">Status:</span>

        @if($semester->status)
            <span class="badge active">Active</span>
        @else
            <span class="badge inactive">Inactive</span>
        @endif
    </div>

    <div class="buttons">

        <a
            href="{{ route('semesters.edit', $semester) }}"
            class="btn edit"
        >
            Edit
        </a>

        <a
            href="{{ route('semesters.index') }}"
            class="btn back"
        >
            Back to Semesters
        </a>

    </div>

</div>

</body>
</html>