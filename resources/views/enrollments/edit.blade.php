<!DOCTYPE html>
<html>
<head>
    <title>Edit Enrollment</title>
</head>
<body>

<h2>Edit Enrollment</h2>

<form
    action="{{ route('enrollments.update', $enrollment->id) }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <!-- Student -->
    <label>Student</label>

    <select name="student_id" required>
        <option value="">Select Student</option>

        @foreach($students as $student)
            <option
                value="{{ $student->id }}"
                {{ $enrollment->student_id == $student->id ? 'selected' : '' }}
            >
                {{ $student->name }}
            </option>
        @endforeach
    </select>

    <br><br>


    <!-- Class -->
    <label>Class</label>

    <select name="class_id" required>
        <option value="">Select Class</option>

        @foreach($classes as $class)
            <option
                value="{{ $class->id }}"
                {{ $enrollment->class_id == $class->id ? 'selected' : '' }}
            >
                {{ $class->name }}
                {{ $class->section }}
            </option>
        @endforeach
    </select>

    <br><br>


    <!-- Academic Year -->
    <label>Academic Year</label>

    <select name="academic_year_id" required>
        <option value="">Select Academic Year</option>

        @foreach($academicYears as $year)
            <option
                value="{{ $year->id }}"
                {{ $enrollment->academic_year_id == $year->id ? 'selected' : '' }}
            >
                {{ $year->name }}
            </option>
        @endforeach
    </select>

    <br><br>


    <!-- Enrollment Date -->
    <label>Enrollment Date</label>

    <input
        type="date"
        name="enrollment_date"
        value="{{ $enrollment->enrollment_date }}"
    >

    <br><br>


    <!-- Status -->
    <label>Status</label>

    <select name="status" required>

        <option
            value="active"
            {{ $enrollment->status == 'active' ? 'selected' : '' }}
        >
            Active
        </option>

        <option
            value="inactive"
            {{ $enrollment->status == 'inactive' ? 'selected' : '' }}
        >
            Inactive
        </option>

        <option
            value="completed"
            {{ $enrollment->status == 'completed' ? 'selected' : '' }}
        >
            Completed
        </option>

    </select>

    <br><br>

    <button type="submit">
        Update Enrollment
    </button>

    <a href="{{ route('enrollments.index') }}">
        Cancel
    </a>

</form>

</body>
</html>