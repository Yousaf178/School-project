
@extends('layouts.app')

@section('title', 'Teachers')

@section('content')

<div class="container">
<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form action="{{ route('teachers.index') }}" method="GET">

            <div class="row g-3">

                {{-- Search --}}
                <div class="col-md-5">

                    <label class="form-label">
                        Search Teacher
                    </label>

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Name, email, phone, subject..."
                        value="{{ request('search') }}"
                    >

                </div>


                {{-- Subject --}}
                <div class="col-md-3">

                    <label class="form-label">
                        Subject
                    </label>

                    <select name="subject" class="form-select">

                        <option value="">
                            All Subjects
                        </option>

                        @foreach($subjects as $subject)

                            <option
                                value="{{ $subject }}"
                                {{ request('subject') == $subject ? 'selected' : '' }}
                            >
                                {{ $subject }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Status --}}
                <div class="col-md-2">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status" class="form-select">

                        <option value="">
                            All
                        </option>

                        <option
                            value="1"
                            {{ request('status') === '1' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            {{ request('status') === '0' ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- Buttons --}}
                <div class="col-md-2 d-flex align-items-end">

                    <button type="submit" class="btn btn-primary me-2">
                        Search
                    </button>

                    <a
                        href="{{ route('teachers.index') }}"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>

                </div>

            </div>

        </form>

    </div>
</div>
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Teachers</h1>

        <a href="{{ route('teachers.create') }}" class="btn btn-success">
            + Add Teacher
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Profile</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($teachers as $teacher)

                            <tr>

                                <td>
    @if($teacher->profile_image)
        <img
            src="{{ asset('storage/' . $teacher->profile_image) }}"
            width="60"
            height="60"
            class="rounded-circle"
            style="object-fit: cover;"
            alt="Teacher Profile"
        >
    @else
        <span class="text-muted">No Image</span>
    @endif
</td>

                                <td>{{ $teacher->first_name }}</td>

                                <td>{{ $teacher->last_name }}</td>

                                <td>{{ $teacher->email }}</td>

                                <td>{{ $teacher->phone ?? 'N/A' }}</td>

                                <td>
    {{ $teacher->subject->name ?? 'N/A' }}
</td>
                                <td>{{ $teacher->country ?? 'N/A' }}</td>

                                <td>
                                    @if($teacher->status)
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td>

                                    <a href="{{ route('teachers.show', $teacher->id) }}"
                                       class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    <a href="{{ route('teachers.edit', $teacher->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('teachers.destroy', $teacher->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this teacher?')">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="text-center py-5">

                                    <h5>No teachers found</h5>

                                    <p class="text-muted">
                                        Add your first teacher.
                                    </p>

                                    <a href="{{ route('teachers.create') }}"
                                       class="btn btn-success">
                                        + Add Teacher
                                    </a>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
