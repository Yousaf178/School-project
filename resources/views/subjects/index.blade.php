@extends('layouts.app')

@section('title', 'Subjects')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Subjects</h1>

        <a href="{{ route('subjects.create') }}"
           class="btn btn-success">
            + Add Subject
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- Search and Filter --}}
    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form action="{{ route('subjects.index') }}"
                  method="GET">

                <div class="row g-3">

                    {{-- Search --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search subject..."
                            value="{{ request('search') }}"
                        >

                    </div>


                    {{-- Status --}}
                    <div class="col-md-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="">
                                All
                            </option>

                            <option value="1"
                                {{ request('status') === '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ request('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-md-3 d-flex align-items-end">

                        <button type="submit"
                                class="btn btn-primary me-2">
                            Search
                        </button>

                        <a href="{{ route('subjects.index') }}"
                           class="btn btn-secondary">
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Subjects Table --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Subject Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($subjects as $subject)

                            <tr>

                                <td>
                                    {{ $subject->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $subject->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $subject->description ?? '-' }}
                                </td>

                                <td>

                                    @if($subject->status)

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
{{-- Teachers --}}
    <a href="{{ route('subjects.teachers', $subject) }}"
       class="btn btn-sm btn-primary">
        Teachers
    </a>

                                    <a href="{{ route('subjects.show', $subject) }}"
                                       class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    <a href="{{ route('subjects.edit', $subject) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('subjects.destroy', $subject) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this subject?')"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center text-muted">

                                    No subjects found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            <div class="mt-3">

                {{ $subjects->links() }}

            </div>

        </div>

    </div>

</div>

@endsection