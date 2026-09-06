<!DOCTYPE html>
<html>
<head>
    <title>Daily Attendance</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-4">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Daily Attendance</h2>

        <a href="{{ route('attendances.index') }}"
           class="btn btn-secondary">
            Attendance List
        </a>

    </div>

    {{-- Select Class and Date --}}
    <div class="card mb-4">

        <div class="card-body">

            <form action="{{ route('attendances.saveDaily') }}" method="POST">

    @csrf

    <input type="hidden"
           name="class_id"
           value="{{ $selectedClass }}">

    <input type="hidden"
           name="attendance_date"
           value="{{ $selectedDate }}">

    <table class="table table-bordered">

        <thead class="table-dark">

            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Status</th>
                <th>Remarks</th>
            </tr>

        </thead>

        <tbody>

            @foreach($students as $student)

                @php
                    $attendance = $attendances->get($student->id);
                @endphp

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $student->name }}
                    </td>

                    <td>

                        <select
                            name="attendance[{{ $student->id }}][status]"
                            class="form-select"
                            required
                        >

                            <option value="present"
                                {{ ($attendance->status ?? 'present') == 'present' ? 'selected' : '' }}>
                                Present
                            </option>

                            <option value="absent"
                                {{ ($attendance->status ?? '') == 'absent' ? 'selected' : '' }}>
                                Absent
                            </option>

                            <option value="late"
                                {{ ($attendance->status ?? '') == 'late' ? 'selected' : '' }}>
                                Late
                            </option>

                            <option value="excused"
                                {{ ($attendance->status ?? '') == 'excused' ? 'selected' : '' }}>
                                Excused
                            </option>

                        </select>

                    </td>

                    <td>

                        <input
                            type="text"
                            name="attendance[{{ $student->id }}][remarks]"
                            class="form-control"
                            value="{{ $attendance->remarks ?? '' }}"
                            placeholder="Remarks"
                        >

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="text-end">

        <button type="submit"
                class="btn btn-success">

            Save Daily Attendance

        </button>

    </div>

</form>

        </div>

    </div>


    @if($selectedClass && $students->count())

        <div class="card">

            <div class="card-header">
                <strong>
                    Attendance for {{ $selectedDate }}
                </strong>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead class="table-dark">

                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($students as $student)

                            @php
                                $attendance = $attendances->get($student->id);
                            @endphp

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
{{ trim($student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name) }}                                </td>

                                <td>

                                    <select class="form-select">

                                        <option value="present"
                                            {{ ($attendance->status ?? 'present') == 'present' ? 'selected' : '' }}>
                                            Present
                                        </option>

                                        <option value="absent"
                                            {{ ($attendance->status ?? '') == 'absent' ? 'selected' : '' }}>
                                            Absent
                                        </option>

                                        <option value="late"
                                            {{ ($attendance->status ?? '') == 'late' ? 'selected' : '' }}>
                                            Late
                                        </option>

                                        <option value="excused"
                                            {{ ($attendance->status ?? '') == 'excused' ? 'selected' : '' }}>
                                            Excused
                                        </option>

                                    </select>

                                </td>

                                <td>

                                    <input type="text"
                                           class="form-control"
                                           value="{{ $attendance->remarks ?? '' }}"
                                           placeholder="Remarks">

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    @elseif($selectedClass)

        <div class="alert alert-warning">
            No students found.
        </div>

    @endif

</div>

</body>
</html>