<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Departments - Registrar System</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #172554;
            color: white;
            padding: 25px 15px;
        }

        .logo {
            text-align: center;
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 35px;
        }

        .logo span {
            display: block;
            font-size: 12px;
            font-weight: normal;
            color: #bfdbfe;
            margin-top: 5px;
        }

        .menu a {
            display: block;
            padding: 13px 15px;
            margin-bottom: 5px;
            border-radius: 7px;
            color: #e0e7ff;
            text-decoration: none;
        }

        .menu a:hover,
        .menu .active {
            background: #2563eb;
            color: white;
        }

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            border-bottom: 1px solid #e5e7eb;
        }

        .content {
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 28px;
        }

        .page-header p {
            color: #6b7280;
            margin-top: 6px;
        }

        .btn {
            display: inline-block;
            padding: 11px 17px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-view {
            background: #e0f2fe;
            color: #0369a1;
        }

        .btn-edit {
            background: #fef3c7;
            color: #92400e;
        }

        .btn-delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            color: #475569;
            text-align: left;
            padding: 15px;
            font-size: 13px;
            text-transform: uppercase;
        }

        td {
            padding: 15px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
        }

        tr:hover {
            background: #f8fafc;
        }

        .status {
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

        .alert {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #dcfce7;
            color: #166534;
        }

        .actions {
            display: flex;
            gap: 7px;
        }

        .actions form {
            display: inline;
        }

        .empty {
            text-align: center;
            padding: 50px;
            color: #6b7280;
        }

        .pagination {
            padding: 20px;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
            }

            table {
                min-width: 800px;
            }

            .table-card {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">

    <div class="logo">
        🎓 REGISTRAR
        <span>Management System</span>
    </div>

    <nav class="menu">

        <a href="{{ route('dashboard') }}">
            🏠 Dashboard
        </a>

        <a href="#">
            👨‍🎓 Students
        </a>

        <a href="{{ route('departments.index') }}" class="active">
            🏫 Departments
        </a>

        <a href="#">
            🎓 Programs
        </a>

        <a href="#">
            📚 Courses
        </a>

        <a href="#">
            📅 Academic Years
        </a>

        <a href="#">
            📝 Registration
        </a>

        <a href="#">
            📊 Grades
        </a>

        <a href="#">
            📜 Transcript
        </a>

        <a href="#">
            🎓 Graduation
        </a>

        <a href="#">
            📈 Reports
        </a>

    </nav>

</aside>


<main class="main">

    <header class="topbar">

        <strong>Department Management</strong>

        <div>
            👤 {{ auth()->user()->name }}
        </div>

    </header>


    <section class="content">

        <div class="page-header">

            <div>
                <h1>Departments</h1>

                <p>
                    Manage academic departments
                </p>
            </div>

            <a href="{{ route('departments.create') }}"
               class="btn btn-primary">
                + Add Department
            </a>

        </div>


        @if (session('success'))

            <div class="alert">
                {{ session('success') }}
            </div>

        @endif


        <div class="table-card">

            @if ($departments->count())

                <table>

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Department</th>
                            <th>Head</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    @foreach ($departments as $department)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $department->code }}
                                </strong>
                            </td>

                            <td>
                                {{ $department->name }}
                            </td>

                            <td>
                                {{ $department->head_name ?? '—' }}
                            </td>

                            <td>

                                @if ($department->status)

                                    <span class="status active">
                                        Active
                                    </span>

                                @else

                                    <span class="status inactive">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="actions">

                                    <a
                                        href="{{ route('departments.show', $department) }}"
                                        class="btn btn-view">
                                        View
                                    </a>

                                    <a
                                        href="{{ route('departments.edit', $department) }}"
                                        class="btn btn-edit">
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('departments.destroy', $department) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this department?');">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-delete">
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
                    {{ $departments->links() }}
                </div>

            @else

                <div class="empty">

                    <h3>No departments found</h3>

                    <p>
                        Start by creating your first department.
                    </p>

                    <br>

                    <a
                        href="{{ route('departments.create') }}"
                        class="btn btn-primary">
                        + Add Department
                    </a>

                </div>

            @endif

        </div>

    </section>

</main>

</body>
</html>