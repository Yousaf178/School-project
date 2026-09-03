
@extends('layouts.app')

@section('title', 'Teacher Details')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Teacher Details</h1>

        <div>
            <a href="{{ route('teachers.edit', $teacher->id) }}"
               class="btn btn-warning">
                Edit
            </a>

            <a href="{{ route('teachers.index') }}"
               class="btn btn-secondary">
                ← Back
            </a>
        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="mb-0">Teacher Information</h5>
        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-6">
                    <strong>First Name:</strong>
                    <p>{{ $teacher->first_name }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Last Name:</strong>
                    <p>{{ $teacher->last_name }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Email:</strong>
                    <p>{{ $teacher->email }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Phone:</strong>
                    <p>{{ $teacher->phone ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Subject:</strong>
                    <p>{{ $teacher->subject ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Country:</strong>
                    <p>{{ $teacher->country ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6">
                    <strong>Status:</strong>

                    <p>
                        @if($teacher->status)
                            <span class="badge bg-success">
                                Active
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Inactive
                            </span>
                        @endif
                    </p>
                </div>

                <div class="col-md-6">
                    <strong>Created At:</strong>
                    <p>{{ $teacher->created_at->format('d M Y, h:i A') }}</p>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
