
@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Edit Teacher</h1>

        <a href="{{ route('teachers.index') }}"
           class="btn btn-secondary">
            ← Back to Teachers
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('teachers.update', $teacher->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- First Name -->
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>

                        <input type="text"
                               name="first_name"
                               class="form-control"
                               value="{{ old('first_name', $teacher->first_name) }}"
                               required>

                        @error('first_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>

                        <input type="text"
                               name="last_name"
                               class="form-control"
                               value="{{ old('last_name', $teacher->last_name) }}"
                               required>

                        @error('last_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email</label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $teacher->email) }}"
                               required>

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label">Phone No</label>

                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone', $teacher->phone) }}">
                    </div>

                    <!-- Subject -->
                    <div class="col-md-6">

    <label class="form-label">
        Subject
    </label>

    <select name="subject" class="form-select" required>

        <option value="">
            Select Subject
        </option>

        @foreach($subjects as $subject)

            <option
                value="{{ $subject->name }}"
                {{ old('subject', $teacher->subject) == $subject->name ? 'selected' : '' }}
            >
                {{ $subject->name }}
            </option>

        @endforeach

    </select>

    @error('subject')
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror

</div>

                    <!-- Country -->
                    <div class="col-md-6">
                        <label class="form-label">Country</label>

                        <input type="text"
                               name="country"
                               class="form-control"
                               value="{{ old('country', $teacher->country) }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">

                            <option value="1"
                                {{ old('status', $teacher->status) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status', $teacher->status) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>
                    </div>

                </div>

                <div class="mt-4">

                    <button type="submit" class="btn btn-primary">
                        Update Teacher
                    </button>

                    <a href="{{ route('teachers.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection