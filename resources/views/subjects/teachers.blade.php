@extends('layouts.app')

@section('title', $subject->name . ' Teachers')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>{{ $subject->name }} Teachers</h1>

        <a href="{{ route('subjects.index') }}"
           class="btn btn-secondary">
            ← Back to Subjects
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Teacher</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($teachers as $teacher)

                        <tr>

                            <td>{{ $teacher->id }}</td>

                            <td>
                                {{ $teacher->first_name }}
                                {{ $teacher->last_name }}
                            </td>

                            <td>{{ $teacher->email }}</td>

                            <td>{{ $teacher->phone ?? '-' }}</td>

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

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center">
                                No teachers assigned to this subject.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            {{ $teachers->links() }}

        </div>

    </div>

</div>

@endsection