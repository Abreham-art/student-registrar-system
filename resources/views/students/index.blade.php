<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Registrar System</title>

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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
            color: #1f2937;
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
            background: #1d4ed8;
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

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f3f4f6;
            color: #374151;
        }

        .actions a,
        .actions button {
            margin-right: 5px;
        }

        .view {
            color: #2563eb;
            text-decoration: none;
        }

        .edit {
            color: #ca8a04;
            text-decoration: none;
        }

        .delete {
            background: #dc2626;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete:hover {
            background: #b91c1c;
        }

        .status {
            padding: 5px 9px;
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

        .pagination {
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Students</h1>

        <a href="{{ route('students.create') }}" class="btn">
            + Add Student
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
                <th>Name</th>
                <th>Gender</th>
                <th>Department</th>
                <th>Program</th>
                <th>Academic Year</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        @forelse($students as $student)

            <tr>
                <td>{{ $students->firstItem() + $loop->index }}</td>

                <td>
                    <strong>{{ $student->student_id }}</strong>
                </td>

                <td>
                    {{ $student->first_name }}
                    {{ $student->middle_name }}
                    {{ $student->last_name }}
                </td>

                <td>{{ $student->gender }}</td>

                <td>
                    {{ $student->department->name ?? 'N/A' }}
                </td>

                <td>
                    {{ $student->program->name ?? 'N/A' }}
                </td>

                <td>
                    {{ $student->academicYear->name ?? 'N/A' }}
                </td>

                <td>
                    <span class="status
                        {{ $student->status === 'Active' ? 'active' : 'inactive' }}">
                        {{ $student->status }}
                    </span>
                </td>

                <td class="actions">

                    <a
                        href="{{ route('students.show', $student) }}"
                        class="view">
                        View
                    </a>

                    <a
                        href="{{ route('students.edit', $student) }}"
                        class="edit">
                        Edit
                    </a>

                    <form
                        action="{{ route('students.destroy', $student) }}"
                        method="POST"
                        style="display:inline;"
                        onsubmit="return confirm('Are you sure you want to delete this student?');">

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
                <td colspan="9" style="text-align:center;">
                    No students found.
                </td>
            </tr>

        @endforelse

        </tbody>
    </table>

    <div class="pagination">
        {{ $students->links() }}
    </div>

</div>

</body>
</html>