<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Attendance</h2>

        <a href="{{ route('attendances.create') }}"
           class="btn btn-primary">
            + Add Attendance
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Class</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($attendances as $attendance)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
{{ $attendance->student
    ? trim(
        $attendance->student->first_name . ' ' .
        $attendance->student->middle_name . ' ' .
        $attendance->student->last_name
    )
    : 'N/A'
}}
                                </td>

                                <td>
                                    {{ $attendance->schoolClass->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $attendance->attendance_date->format('d-m-Y') }}
                                </td>

                                <td>

                                    @if($attendance->status == 'present')

                                        <span class="badge bg-success">
                                            Present
                                        </span>

                                    @elseif($attendance->status == 'absent')

                                        <span class="badge bg-danger">
                                            Absent
                                        </span>

                                    @elseif($attendance->status == 'late')

                                        <span class="badge bg-warning text-dark">
                                            Late
                                        </span>

                                    @else

                                        <span class="badge bg-info">
                                            Excused
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $attendance->remarks ?? '-' }}
                                </td>

                                <td>

                                    <a href="{{ route('attendances.edit', $attendance->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('attendances.destroy', $attendance->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this attendance?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7"
                                    class="text-center text-muted">
                                    No attendance records found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

</body>
</html>