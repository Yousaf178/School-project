<!DOCTYPE html>
<html>
<head>
    <title>Add Class</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Add Class</h2>

        <a href="{{ route('classes.index') }}"
           class="btn btn-secondary">
            Back
        </a>
    </div>

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

            <form action="{{ route('classes.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Class Name
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Example: Grade 1"
                           value="{{ old('name') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Section
                    </label>

                    <input type="text"
                           name="section"
                           class="form-control"
                           placeholder="Example: A"
                           value="{{ old('section') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Room
                    </label>

                    <input type="text"
                           name="room"
                           class="form-control"
                           placeholder="Example: 101"
                           value="{{ old('room') }}">
                </div>

                <button type="submit"
                        class="btn btn-success">
                    Save Class
                </button>

                <a href="{{ route('classes.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>