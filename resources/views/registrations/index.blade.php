<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrations - Registrar System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        h1 {
            margin-bottom: 20px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            background: #2563eb;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f1f5f9;
        }

        .actions a,
        .actions button {
            margin-right: 5px;
        }

        .view {
            background: #16a34a;
        }

        .edit {
            background: #f59e0b;
        }

        .delete {
            background: #dc2626;
            border: none;
            cursor: pointer;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top">
        <h1>Course Registrations</h1>

        <a href="{{ route('registrations.create') }}" class="btn">
            + New Registration
        </a>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <table>

        <thead>
            <tr>
                <th>#</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Academic Year</th>
                <th>Semester</th>
                <th>Registration Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($registrations as $registration)

                <tr>

                    <td>
                        {{ $registrations->firstItem() + $loop->index }}
                    </td>

                    <td>
                        {{ $registration->student->student_id ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $registration->student->first_name ?? '' }}
                        {{ $registration->student->middle_name ?? '' }}
                        {{ $registration->student->last_name ?? '' }}
                    </td>

                    <td>
                        {{ $registration->semester->academicYear->name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $registration->semester->name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $registration->registration_date?->format('Y-m-d') ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $registration->status }}
                    </td>

                    <td class="actions">

                        <a
                            href="{{ route('registrations.show', $registration) }}"
                            class="btn view"
                        >
                            View
                        </a>

                        <a
                            href="{{ route('registrations.edit', $registration) }}"
                            class="btn edit"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('registrations.destroy', $registration) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Are you sure you want to delete this registration?');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn delete"
                            >
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="8" style="text-align:center;">
                        No registrations found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="pagination">
        {{ $registrations->links() }}
    </div>

</div>

</body>
</html>