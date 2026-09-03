@extends('layouts.app')

@section('title', 'Add Teacher')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Add Teacher</h1>

        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
            ← Back to Teachers
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('teachers.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row g-3">

                    {{-- First Name --}}
                    <div class="col-md-6">

                        <label class="form-label">First Name</label>

                        <input
                            type="text"
                            name="first_name"
                            class="form-control"
                            value="{{ old('first_name') }}"
                            required
                        >

                        @error('first_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>


                    {{-- Last Name --}}
                    <div class="col-md-6">

                        <label class="form-label">Last Name</label>

                        <input
                            type="text"
                            name="last_name"
                            class="form-control"
                            value="{{ old('last_name') }}"
                            required
                        >

                        @error('last_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>


                    {{-- Email --}}
                    <div class="col-md-6">

                        <label class="form-label">Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required
                        >

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>


                    {{-- Profile Image --}}
                    <div class="col-md-6">

                        <label class="form-label">Profile Image</label>

                        <input
                            type="file"
                            name="profile_image"
                            class="form-control"
                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                        >

                        <small class="text-muted">
                            JPG, JPEG, PNG, GIF or WEBP. Maximum 2MB.
                        </small>

                        @error('profile_image')
                            <small class="text-danger d-block">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Phone --}}
                    <div class="col-md-6">

                        <label class="form-label">Phone No</label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone') }}"
                        >

                    </div>


                    {{-- Subject --}}
                   <div class="col-md-6">
    <label class="form-label">Subject</label>

    <select name="subject_id" class="form-select" required>

        <option value="">Select Subject</option>

        @foreach($subjects as $subject)

            <option
                value="{{ $subject->id }}"
                {{ old('subject_id') == $subject->id ? 'selected' : '' }}
            >
                {{ $subject->name }}
            </option>

        @endforeach

    </select>

    @error('subject_id')
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror
</div>


                    {{-- Country --}}
                    <div class="col-md-6">

                        <label class="form-label">Country</label>

                        <input
                            type="text"
                            name="country"
                            class="form-control"
                            value="{{ old('country') }}"
                        >

                    </div>


                    {{-- Status --}}
                    <div class="col-md-6">

                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">

                            <option value="1"
                                {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>


                {{-- Buttons --}}
                <div class="mt-4">

                    <button type="submit" class="btn btn-success">
                        Save Teacher
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