<h2>Enroll Student</h2>

<form action="{{ route('enrollments.store') }}" method="POST">
    @csrf

    {{-- Student --}}
    <div>
        <label>Student</label>

        <select name="student_id" required>
            <option value="">Select Student</option>

            @foreach($students as $student)
          
                <option
    value="{{ $student->id }}"
    {{ old('student_id') == $student->id ? 'selected' : '' }}
>
    {{ $student->first_name }}
    {{ $student->middle_name }}
    {{ $student->last_name }}
</option>
                
            @endforeach
        </select>

        @error('student_id')
            <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    <br>

    {{-- Class --}}
    <div>
        <label>Class</label>

        <select name="class_id" required>
            <option value="">Select Class</option>

            @foreach($classes as $class)
                <option value="{{ $class->id }}"
                    {{ old('class_id') == $class->id ? 'selected' : '' }}>
                    {{ $class->name }} {{ $class->section }}
                </option>
            @endforeach
        </select>

        @error('class_id')
            <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    <br>

    {{-- Academic Year --}}
    <div>
        <label>Academic Year</label>

        <select name="academic_year_id" required>
            <option value="">Select Academic Year</option>

            @foreach($academicYears as $year)
                <option value="{{ $year->id }}"
                    {{ old('academic_year_id') == $year->id ? 'selected' : '' }}>
                    {{ $year->name }}
                </option>
            @endforeach
        </select>

        @error('academic_year_id')
            <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    <br>

    {{-- Enrollment Date --}}
    <div>
        <label>Enrollment Date</label>

        <input
            type="date"
            name="enrollment_date"
            value="{{ old('enrollment_date', date('Y-m-d')) }}"
        >

        @error('enrollment_date')
            <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    <br>

    {{-- Status --}}
    <div>
        <label>Status</label>

        <select name="status" required>
            <option value="active"
                {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                Active
            </option>

            <option value="inactive"
                {{ old('status') == 'inactive' ? 'selected' : '' }}>
                Inactive
            </option>

            <option value="completed"
                {{ old('status') == 'completed' ? 'selected' : '' }}>
                Completed
            </option>
        </select>

        @error('status')
            <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    <br>

    <button type="submit">
        Enroll Student
    </button>
</form>