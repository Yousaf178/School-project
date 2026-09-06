<!DOCTYPE html>
<html>
<head>
    <title>Edit Attendance</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Attendance</h2>

        <a href="{{ route('attendances.index') }}"
           class="btn btn-secondary">
            Back
        </a>
    </div>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('attendances.update', $attendance->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Student --}}
                <div class="mb-3">
                    <label class="form-label">
                        Student
                    </label>

                    <select name="student_id"
                            class="form-select"
                            required>

                        <option value="">
                            -- Select Student --
                        </option>

                        @foreach($students as $student)

                            <option value="{{ $student->id }}"
                                {{ old('student_id', $attendance->student_id) == $student->id ? 'selected' : '' }}>

{{ trim($student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name) }}
                            </option>

                        @endforeach

                    </select>
                </div>

                {{-- Class --}}
                <div class="mb-3">
                    <label class="form-label">
                        Class
                    </label>

                    <select name="class_id"
                            class="form-select"
                            required>

                        <option value="">
                            -- Select Class --
                        </option>

                        @foreach($classes as $class)

                            <option value="{{ $class->id }}"
                                {{ old('class_id', $attendance->class_id) == $class->id ? 'selected' : '' }}>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>
                </div>

                {{-- Date --}}
                <div class="mb-3">
                    <label class="form-label">
                        Attendance Date
                    </label>

                    <input type="date"
                           name="attendance_date"
                           class="form-control"
                           value="{{ old('attendance_date', $attendance->attendance_date->format('Y-m-d')) }}"
                           required>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-select"
                            required>

                        <option value="present"
                            {{ old('status', $attendance->status) == 'present' ? 'selected' : '' }}>
                            Present
                        </option>

                        <option value="absent"
                            {{ old('status', $attendance->status) == 'absent' ? 'selected' : '' }}>
                            Absent
                        </option>

                        <option value="late"
                            {{ old('status', $attendance->status) == 'late' ? 'selected' : '' }}>
                            Late
                        </option>

                        <option value="excused"
                            {{ old('status', $attendance->status) == 'excused' ? 'selected' : '' }}>
                            Excused
                        </option>

                    </select>
                </div>

                {{-- Remarks --}}
                <div class="mb-3">
                    <label class="form-label">
                        Remarks
                    </label>

                    <textarea name="remarks"
                              class="form-control"
                              rows="3"
                              placeholder="Optional remarks">{{ old('remarks', $attendance->remarks) }}</textarea>
                </div>

                <button type="submit"
                        class="btn btn-success">
                    Update Attendance
                </button>

                <a href="{{ route('attendances.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>