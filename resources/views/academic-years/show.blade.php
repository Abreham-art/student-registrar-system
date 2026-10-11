<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Year Details</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 30px;
        }

        .container {
            max-width: 750px;
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
            display: inline-block;
            width: 180px;
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 16px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
        }

        .back {
            background: #6b7280;
        }

        .edit {
            background: #f59e0b;
            margin-left: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Academic Year Details</h1>

    <div class="row">
        <span class="label">Academic Year:</span>
        {{ $academicYear->name }}
    </div>

    <div class="row">
        <span class="label">Start Date:</span>
        {{ $academicYear->start_date->format('d M Y') }}
    </div>

    <div class="row">
        <span class="label">End Date:</span>
        {{ $academicYear->end_date->format('d M Y') }}
    </div>

    <div class="row">
        <span class="label">Status:</span>

        @if($academicYear->status)
            <span style="color:green;">Active</span>
        @else
            <span style="color:red;">Inactive</span>
        @endif
    </div>

    <a href="{{ route('academic-years.index') }}" class="back">
        ← Back
    </a>

    <a href="{{ route('academic-years.edit', $academicYear) }}" class="edit">
        Edit
    </a>

</div>

</body>
</html>