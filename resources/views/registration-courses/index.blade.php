<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration Courses - Registrar System</title>

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

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
        }

        .btn {
            display: inline-block;
            padding: 9px 13px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
            margin-right: 4px;
        }

        .add {
            background: #2563eb;
        }

        .view {
            background: #16a34a;
        }

        .edit {
            background: #f59e0b;
        }

        .delete {
            background: #dc2626;
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

        .actions {
            white-space: nowrap;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top">

        <h1>Registration Courses</h1>

        <a
            href="{{ route('registration-courses.create') }}"
            class="btn add"
        >
            + Add Course
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
                <th>Student</th>
                <th>Student ID</th>
                <th>Academic Year</th>
                <th>Semester</th>
                <th>Course</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

            @forelse($registrationCourses as $registrationCourse)

                <tr>

                    <td>
                        {{ $registrationCourses->firstItem() + $loop->index }}
                    </td>

                    <td>
                        {{ $registrationCourse->registration->student->first_name ?? '' }}
                        {{ $registrationCourse->registration->student->last_name ?? '' }}
                    </td>

                    <td>
                        {{ $registrationCourse->registration->student->student_id ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $registrationCourse->registration->semester->academicYear->name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $registrationCourse->registration->semester->name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $registrationCourse->courseOffering->course->code ?? 'N/A' }}
                        -
                        {{ $registrationCourse->courseOffering->course->name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $registrationCourse->status }}
                    </td>

                    <td class="actions">

                        <a
                            href="{{ route('registration-courses.show', $registrationCourse) }}"
                            class="btn view"
                        >
                            View
                        </a>

                        <a
                            href="{{ route('registration-courses.edit', $registrationCourse) }}"
                            class="btn edit"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('registration-courses.destroy', $registrationCourse) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Are you sure you want to remove this course from the registration?');"
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

                    <td
                        colspan="8"
                        style="text-align:center;"
                    >
                        No registration courses found.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    <div class="pagination">

        {{ $registrationCourses->links() }}

    </div>

</div>

</body>
</html>