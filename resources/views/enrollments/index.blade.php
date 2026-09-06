<!DOCTYPE html>
<html>
<head>
    <title>Enrollments</title>
</head>
<body>

<h2>Student Enrollments</h2>

@if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('enrollments.create') }}">
    <button>Add Enrollment</button>
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">

    <thead>
        <tr>
            <th>#</th>
            <th>Student</th>
            <th>Class</th>
            <th>Academic Year</th>
            <th>Enrollment Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        @forelse($enrollments as $enrollment)

            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>
                    {{ $enrollment->student->name ?? 'N/A' }}
                </td>

                <td>
                    {{ $enrollment->schoolClass->name ?? 'N/A' }}
                    {{ $enrollment->schoolClass->section ?? '' }}
                </td>

                <td>
                    {{ $enrollment->academicYear->name ?? 'N/A' }}
                </td>

                <td>
                    {{ $enrollment->enrollment_date ?? 'N/A' }}
                </td>

                <td>
                    {{ ucfirst($enrollment->status) }}
                </td>

                <td>

                    <a href="{{ route('enrollments.edit', $enrollment->id) }}">
                        <button>Edit</button>
                    </a>

                    <form
                        action="{{ route('enrollments.destroy', $enrollment->id) }}"
                        method="POST"
                        style="display:inline;"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Are you sure you want to delete this enrollment?')"
                        >
                            Delete
                        </button>

                    </form>

                </td>
            </tr>

        @empty

            <tr>
                <td colspan="7">
                    No enrollments found.
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

</body>
</html>