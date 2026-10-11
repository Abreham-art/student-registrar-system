<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Student - Registrar System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
            color: #1f2937;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #374151;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box;
        }

        input:focus,
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
            margin-top: 25px;
        }

        .btn {
            padding: 11px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .save {
            background: #2563eb;
            color: white;
        }

        .save:hover {
            background: #1d4ed8;
        }

        .cancel {
            background: #6b7280;
            color: white;
            margin-left: 8px;
        }

        .cancel:hover {
            background: #4b5563;
        }

        .required {
            color: #dc2626;
        }

        @media (max-width: 700px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .full {
                grid-column: auto;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Add New Student</h1>

    @if ($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:15px; border-radius:6px; margin-bottom:20px;">
            <strong>Please correct the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="grid">

            {{-- Student ID --}}
            <div>
                <label>
                    Student ID <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="student_id"
                    value="{{ old('student_id') }}"
                    placeholder="e.g. STU001"
                    required
                >

                @error('student_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- First Name --}}
            <div>
                <label>
                    First Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="first_name"
                    value="{{ old('first_name') }}"
                    required
                >

                @error('first_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Middle Name --}}
            <div>
                <label>Middle Name</label>

                <input
                    type="text"
                    name="middle_name"
                    value="{{ old('middle_name') }}"
                >

                @error('middle_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Last Name --}}
            <div>
                <label>
                    Last Name <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="last_name"
                    value="{{ old('last_name') }}"
                    required
                >

                @error('last_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Gender --}}
            <div>
                <label>
                    Gender <span class="required">*</span>
                </label>

                <select name="gender" required>
                    <option value="">-- Select Gender --</option>

                    <option value="Male"
                        {{ old('gender') === 'Male' ? 'selected' : '' }}>
                        Male
                    </option>

                    <option value="Female"
                        {{ old('gender') === 'Female' ? 'selected' : '' }}>
                        Female
                    </option>
                </select>

                @error('gender')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Date of Birth --}}
            <div>
                <label>Date of Birth</label>

                <input
                    type="date"
                    name="date_of_birth"
                    value="{{ old('date_of_birth') }}"
                >

                @error('date_of_birth')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Phone --}}
            <div>
                <label>Phone</label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="e.g. 0912345678"
                >

                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="student@example.com"
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Department --}}
            <div>
                <label>
                    Department <span class="required">*</span>
                </label>

                <select name="department_id" required>
                    <option value="">-- Select Department --</option>

                    @foreach ($departments as $department)
                        <option
                            value="{{ $department->id }}"
                            {{ old('department_id') == $department->id ? 'selected' : '' }}
                        >
                            {{ $department->code }} - {{ $department->name }}
                        </option>
                    @endforeach
                </select>

                @error('department_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Program --}}
            <div>
                <label>
                    Program <span class="required">*</span>
                </label>

                <select name="program_id" required>
                    <option value="">-- Select Program --</option>

                    @foreach ($programs as $program)
                        <option
                            value="{{ $program->id }}"
                            {{ old('program_id') == $program->id ? 'selected' : '' }}
                        >
                            {{ $program->code }} - {{ $program->name }}
                        </option>
                    @endforeach
                </select>

                @error('program_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Academic Year --}}
            <div>
                <label>
                    Academic Year <span class="required">*</span>
                </label>

                <select name="academic_year_id" required>
                    <option value="">-- Select Academic Year --</option>

                    @foreach ($academicYears as $academicYear)
                        <option
                            value="{{ $academicYear->id }}"
                            {{ old('academic_year_id') == $academicYear->id ? 'selected' : '' }}
                        >
                            {{ $academicYear->name }}
                        </option>
                    @endforeach
                </select>

                @error('academic_year_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Admission Type --}}
            <div>
                <label>
                    Admission Type <span class="required">*</span>
                </label>

                <select name="admission_type" required>
                    <option value="Regular"
                        {{ old('admission_type', 'Regular') === 'Regular' ? 'selected' : '' }}>
                        Regular
                    </option>

                    <option value="Extension"
                        {{ old('admission_type') === 'Extension' ? 'selected' : '' }}>
                        Extension
                    </option>

                    <option value="Transfer"
                        {{ old('admission_type') === 'Transfer' ? 'selected' : '' }}>
                        Transfer
                    </option>

                    <option value="Other"
                        {{ old('admission_type') === 'Other' ? 'selected' : '' }}>
                        Other
                    </option>
                </select>

                @error('admission_type')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label>
                    Status <span class="required">*</span>
                </label>

                <select name="status" required>
                    <option value="Active"
                        {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="Inactive"
                        {{ old('status') === 'Inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                    <option value="Graduated"
                        {{ old('status') === 'Graduated' ? 'selected' : '' }}>
                        Graduated
                    </option>

                    <option value="Withdrawn"
                        {{ old('status') === 'Withdrawn' ? 'selected' : '' }}>
                        Withdrawn
                    </option>
                </select>

                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="buttons">

            <button type="submit" class="btn save">
                Save Student
            </button>

            <a href="{{ route('students.index') }}" class="btn cancel">
                Cancel
            </a>

        </div>

    </form>

</div>

</body>
</html>