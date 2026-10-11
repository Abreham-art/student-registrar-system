<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Academic Year</title>

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

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .error {
            color: red;
            margin-top: 5px;
        }

        button, a {
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .save {
            background: #2563eb;
            color: white;
        }

        .cancel {
            background: #6b7280;
            color: white;
            margin-left: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Academic Year</h1>

    <form action="{{ route('academic-years.update', $academicYear) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Academic Year</label>

            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $academicYear->name) }}"
                required
            >

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>

            <input
                type="date"
                name="start_date"
                id="start_date"
                value="{{ old('start_date', $academicYear->start_date->format('Y-m-d')) }}"
                required
            >

            @error('start_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>

            <input
                type="date"
                name="end_date"
                id="end_date"
                value="{{ old('end_date', $academicYear->end_date->format('Y-m-d')) }}"
                required
            >

            @error('end_date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>

            <select name="status" id="status" required>

                <option value="1"
                    {{ old('status', $academicYear->status ? '1' : '0') == '1' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('status', $academicYear->status ? '1' : '0') == '0' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="save">
            Update Academic Year
        </button>

        <a href="{{ route('academic-years.index') }}" class="cancel">
            Cancel
        </a>

    </form>

</div>

</body>
</html>