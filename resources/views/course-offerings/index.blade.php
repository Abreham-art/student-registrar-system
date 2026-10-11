<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Offerings - Registrar System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1250px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0;
            color: #1f2937;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
        }

        .add {
            background: #2563eb;
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
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f3f4f6;
            color: #374151;
        }

        .badge {
            padding: 5px 10px;
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

        .actions a,
        .actions button {
            margin-right: 5px;
            padding: 6px 10px;
            border-radius: 5px;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }

        .view {
            background: #0ea5e9;
            color: white;
        }

        .edit {
            background: #f59e0b;
            color: white;
        }

        .delete {
            background: #dc2626;
            color: white;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Course Offerings</h1>

        <a
            href="{{ route('course-offerings.create') }}"
            class="btn add"
        >
            + Add Course Offering
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
                <th>Course</th>
                <th>Academic Year</th>
                <th>Semester</th>
                <th>Instructor</th>
                <th>Capacity</th>
                <th>Room</th>
                <th>Schedule</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        @forelse($courseOfferings as $offering)

            <tr>
                <td>{{ $offering->id }}</td>

                <td>
                    <strong>
                        {{ $offering->course->code ?? 'N/A' }}
                    </strong>
                    <br>
                    {{ $offering->course->name ?? 'N/A' }}
                </td>

                <td>
                    {{ $offering->semester->academicYear->name ?? 'N/A' }}
                </td>

                <td>
                    {{ $offering->semester->semester_number ?? 'N/A' }}
                </td>

                <td>
                    {{ $offering->instructor_name ?? 'Not Assigned' }}
                </td>

                <td>
                    {{ $offering->capacity }}
                </td>

                <td>
                    {{ $offering->room ?? 'N/A' }}
                </td>

                <td>
                    {{ $offering->schedule ?? 'N/A' }}
                </td>

                <td>
                    @if($offering->status)
                        <span class="badge active">Active</span>
                    @else
                        <span class="badge inactive">Inactive</span>
                    @endif
                </td>

                <td class="actions">

                    <a
                        href="{{ route('course-offerings.show', $offering) }}"
                        class="view"
                    >
                        View
                    </a>

                    <a
                        href="{{ route('course-offerings.edit', $offering) }}"
                        class="edit"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route('course-offerings.destroy', $offering) }}"
                        method="POST"
                        style="display:inline;"
                        onsubmit="return confirm('Are you sure you want to delete this course offering?');"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>

        @empty

            <tr>
                <td colspan="10" style="text-align:center;">
                    No course offerings found.
                </td>
            </tr>

        @endforelse

        </tbody>
    </table>

    <div class="pagination">
        {{ $courseOfferings->links() }}
    </div>

</div>

</body>
</html>