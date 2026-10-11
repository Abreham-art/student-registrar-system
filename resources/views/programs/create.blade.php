<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Program - Registrar System</title>

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

        .card h2 {
            margin-top: 0;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #2563eb;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
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

        .btn:hover {
            opacity: 0.9;
        }

        .hint {
            margin-top: 6px;
            color: #6b7280;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Registrar Management System</h1>
    </div>

    <div class="container">

        <div class="card">

            <h2>➕ Add New Academic Program</h2>

            <form method="POST" action="{{ route('programs.store') }}">
                @csrf

                {{-- Department --}}
                <div>
    <label for="department_id">Department</label>

    <select name="department_id" id="department_id" required>
        <option value="">-- Select Department --</option>

        @foreach($departments as $department)
            <option value="{{ $department->id }}"
                {{ old('department_id') == $department->id ? 'selected' : '' }}>
                {{ $department->code }} - {{ $department->name }}
            </option>
        @endforeach
    </select>

    @error('department_id')
        <div style="color:red;">{{ $message }}</div>
    @enderror
</div>

                {{-- Program Code --}}
                <div class="form-group">
                    <label for="code">Program Code *</label>

                    <input
                        type="text"
                        id="code"
                        name="code"
                        value="{{ old('code') }}"
                        placeholder="e.g. BSC-CS"
                        required
                    >

                    <div class="hint">
                        Use a unique code for this program.
                    </div>

                    @error('code')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Program Name --}}
                <div class="form-group">
                    <label for="name">Program Name *</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g. Bachelor of Science in Computer Science"
                        required
                    >

                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Degree Type --}}
                <div class="form-group">
                    <label for="degree_type">Degree Type *</label>

                    <select
                        id="degree_type"
                        name="degree_type"
                        required
                    >
                        <option value="">-- Select Degree Type --</option>

                        <option
                            value="Diploma"
                            {{ old('degree_type') == 'Diploma' ? 'selected' : '' }}
                        >
                            Diploma
                        </option>

                        <option
                            value="Bachelor"
                            {{ old('degree_type') == 'Bachelor' ? 'selected' : '' }}
                        >
                            Bachelor
                        </option>

                        <option
                            value="Master"
                            {{ old('degree_type') == 'Master' ? 'selected' : '' }}
                        >
                            Master
                        </option>

                        <option
                            value="PhD"
                            {{ old('degree_type') == 'PhD' ? 'selected' : '' }}
                        >
                            PhD
                        </option>
                    </select>

                    @error('degree_type')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Duration --}}
                <div class="form-group">
                    <label for="duration_years">Duration (Years) *</label>

                    <input
                        type="number"
                        id="duration_years"
                        name="duration_years"
                        value="{{ old('duration_years') }}"
                        min="1"
                        max="10"
                        placeholder="e.g. 4"
                        required
                    >

                    @error('duration_years')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="form-group">
                    <label for="description">Description</label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Write program description..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label for="status">Status *</label>

                    <select
                        id="status"
                        name="status"
                        required
                    >
                        <option
                            value="1"
                            {{ old('status', '1') == '1' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            {{ old('status') === '0' ? 'selected' : '' }}
                        >
                            Inactive
                        </option>
                    </select>

                    @error('status')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="buttons">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        💾 Save Program
                    </button>

                    <a
                        href="{{ route('programs.index') }}"
                        class="btn btn-secondary"
                    >
                        ← Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>