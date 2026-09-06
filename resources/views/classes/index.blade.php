<!DOCTYPE html>
<html>
<head>
    <title>Classes</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Classes</h2>

        <a href="{{ route('classes.create') }}" class="btn btn-primary">
            + Add Class
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($classes->count())

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Class Name</th>
                    <th>Section</th>
                    <th>Room</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($classes as $class)

                    <tr>
                        <td>{{ $class->id }}</td>

                        <td>
                            {{ $class->name }}
                        </td>

                        <td>
                            {{ $class->section ?? '-' }}
                        </td>

                        <td>
                            {{ $class->room ?? '-' }}
                        </td>

                        <td>

                            <a
                                href="{{ route('classes.edit', $class->id) }}"
                                class="btn btn-warning btn-sm"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('classes.destroy', $class->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this class?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="alert alert-info">
            No classes found.
        </div>

    @endif

</div>

</body>
</html>