<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Details - Registrar System</title>

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
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .title h2 {
            margin: 0;
        }

        .row {
            padding: 18px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .row:last-child {
            border-bottom: none;
        }

        .label {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .value {
            font-size: 17px;
            font-weight: 600;
        }

        .description {
            font-weight: normal;
            line-height: 1.6;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
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

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .delete-form {
            display: inline;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Registrar Management System</h1>
    </div>

    <div class="container">

        <div class="card">

            <div class="title">
                <h2>🏛️ Department Details</h2>
            </div>

            <div class="row">
                <div class="label">Department Code</div>
                <div class="value">
                    {{ $department->code }}
                </div>
            </div>

            <div class="row">
                <div class="label">Department Name</div>
                <div class="value">
                    {{ $department->name }}
                </div>
            </div>

            <div class="row">
                <div class="label">Description</div>
                <div class="value description">
                    {{ $department->description ?: 'No description provided.' }}
                </div>
            </div>

            <div class="row">
                <div class="label">Department Head</div>
                <div class="value">
                    {{ $department->head_name ?: 'Not assigned' }}
                </div>
            </div>

            <div class="row">
                <div class="label">Status</div>

                @if($department->status)
                    <span class="status active">Active</span>
                @else
                    <span class="status inactive">Inactive</span>
                @endif
            </div>

            <div class="row">
                <div class="label">Created At</div>
                <div class="value">
                    {{ $department->created_at->format('d M Y, H:i') }}
                </div>
            </div>

            <div class="row">
                <div class="label">Last Updated</div>
                <div class="value">
                    {{ $department->updated_at->format('d M Y, H:i') }}
                </div>
            </div>

            <div class="buttons">

                <a
                    href="{{ route('departments.edit', $department) }}"
                    class="btn btn-primary"
                >
                    ✏️ Edit
                </a>

                <a
                    href="{{ route('departments.index') }}"
                    class="btn btn-secondary"
                >
                    ← Back
                </a>

                <form
                    method="POST"
                    action="{{ route('departments.destroy', $department) }}"
                    class="delete-form"
                    onsubmit="return confirm('Are you sure you want to delete this department?');"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        🗑️ Delete
                    </button>
                </form>

            </div>

        </div>

    </div>

</body>
</html>