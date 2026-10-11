<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Years</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
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
            margin-right: 5px;
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
        <h1>Academic Years</h1>

        <div>
            <a href="{{ route('dashboard') }}" class="dashboard">
                Dashboard
            </a>

            <a href="{{ route('academic-years.create') }}" class="add">
                + Add Academic Year
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
                <th>Academic Year</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($academicYears as $academicYear)

                <tr>
                    <td>
                        {{ $academicYears->firstItem() + $loop->index }}
                    </td>

                    <td>
                        {{ $academicYear->name }}
                    </td>

                    <td>
                        {{ $academicYear->start_date->format('d M Y') }}
                    </td>

                    <td>
                        {{ $academicYear->end_date->format('d M Y') }}
                    </td>

                    <td>
                        @if($academicYear->status)
                            <span class="active">Active</span>
                        @else
                            <span class="inactive">Inactive</span>
                        @endif
                    </td>

                    <td>

                        <a href="{{ route('academic-years.show', $academicYear) }}"
                           class="view">
                            View
                        </a>

                        <a href="{{ route('academic-years.edit', $academicYear) }}"
                           class="edit">
                            Edit
                        </a>

                        <form action="{{ route('academic-years.destroy', $academicYear) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Delete this academic year?');">

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
                    <td colspan="6" style="text-align:center;">
                        No academic years found.
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>

    <br>

    {{ $academicYears->links() }}

</div>

</body>
</html>