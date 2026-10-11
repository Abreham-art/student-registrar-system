<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs - Registrar System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .header {
            background: #1e3a8a;
            color: white;
            padding: 20px 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
        }

        .container {
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top h2 {
            margin: 0;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #dcfce7;
            color: #166534;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #f8fafc;
            font-size: 13px;
            text-transform: uppercase;
            color: #475569;
        }

        tr:hover {
            background: #f8fafc;
        }

        .code {
            font-weight: bold;
            color: #1e3a8a;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .empty {
            padding: 40px;
            text-align: center;
            color: #6b7280;
        }

        .pagination {
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Registrar Management System</h1>
    </div>

    <div class="container">

        <div class="top">
            <h2>🎓 Academic Programs</h2>

            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    ← Dashboard
                </a>

                <a href="{{ route('programs.create') }}" class="btn btn-primary">
                    + Add Program
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">

            @if($programs->count())

                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Program</th>
                            <th>Department</th>
                            <th>Degree</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($programs as $program)

                            <tr>
                                <td>
                                    {{ $programs->firstItem() + $loop->index }}
                                </td>

                                <td class="code">
                                    {{ $program->code }}
                                </td>

                                <td>
                                    {{ $program->name }}
                                </td>

                                <td>
                                    {{ $program->department->name }}
                                </td>

                                <td>
                                    {{ $program->degree_type }}
                                </td>

                                <td>
                                    {{ $program->duration_years }} year(s)
                                </td>

                                <td>
                                    @if($program->status)
                                        <span class="badge active">Active</span>
                                    @else
                                        <span class="badge inactive">Inactive</span>
                                    @endif
                                </td>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="{{ route('programs.show', $program) }}"
                                            class="btn btn-secondary"
                                        >
                                            View
                                        </a>

                                        <a
                                            href="{{ route('programs.edit', $program) }}"
                                            class="btn btn-warning"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('programs.destroy', $program) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this program?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                            >
                                                Delete
                                            </button>
                                        </form>

                                    </div>

                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>

                <div class="pagination">
                    {{ $programs->links() }}
                </div>

            @else

                <div class="empty">
                    <h3>No Programs Found</h3>

                    <p>
                        No academic programs have been registered yet.
                    </p>

                    <a
                        href="{{ route('programs.create') }}"
                        class="btn btn-primary"
                    >
                        + Add First Program
                    </a>
                </div>

            @endif

        </div>

    </div>

</body>
</html>