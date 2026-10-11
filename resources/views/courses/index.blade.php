<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>

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
        }

        h1 {
            margin-top: 0;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        a, button {
            padding: 9px 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .add {
            background: #2563eb;
            color: white;
        }

        .dashboard {
            background: #6b7280;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f1f5f9;
        }

        .active {
            color: green;
            font-weight: bold;
        }

        .inactive {
            color: red;
            font-weight: bold;
        }

        .actions a {
            margin-right: 5px;
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

        .alert {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top">
        <h1>Courses</h1>

        <div>
            <a href="{{ route('dashboard') }}" class="dashboard">
                Dashboard
            </a>

            <a href="{{ route('courses.create') }}" class="add">
                + Add Course
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Course</th>
                <th>Department</th>
                <th>Credit Hours</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($courses as $course)

                <tr>
                    <td>
                        {{ $courses->firstItem() + $loop->index }}
                    </td>

                    <td>
                        {{ $course->code }}
                    </td>

                    <td>
                        {{ $course->name }}
                    </td>

                    <td>
                        {{ $course->department->name }}
                    </td>

                    <td>
                        {{ $course->credit_hours }}
                    </td>

                    <td>
                        {{ $course->course_type }}
                    </td>

                    <td>
                        @if($course->status)
                            <span class="active">Active</span>
                        @else
                            <span class="inactive">Inactive</span>
                        @endif
                    </td>

                    <td class="actions">

                        <a href="{{ route('courses.show', $course) }}"
                           class="view">
                            View
                        </a>

                        <a href="{{ route('courses.edit', $course) }}"
                           class="edit">
                            Edit
                        </a>

                        <form action="{{ route('courses.destroy', $course) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Delete this course?');">

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
                    <td colspan="8" style="text-align:center;">
                        No courses found.
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>

    <br>

    {{ $courses->links() }}

</div>

</body>
</html>