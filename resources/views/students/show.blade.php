@extends('layouts.app')

@section('title', 'Student Profile')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>Student Profile</h1>

    <div>
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">
            Edit Student
        </a>
<!-- yousaf create a button for pdf download data by yousaf -->
 <a href="{{ route('students.download', $student->id) }}" class="btn btn-danger">
    Download PDF
</a>
 <!-- end -->
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

</div>


<div class="row">

    <!-- Profile Card -->
    <div class="col-md-4">

        <div class="card shadow-sm text-center">
            <div class="card-body">

                @if($student->profile_image)

                    <img
                        src="{{ asset('storage/' . $student->profile_image) }}"
                        width="180"
                        height="180"
                        class="rounded-circle mb-3"
                        style="object-fit: cover;"
                        alt="Profile Image" >

                @else

                    <div
                        class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                        style="width:180px; height:180px;" >
                        No Image
                    </div>

                @endif

                <h3>
                    {{ $student->first_name }}
                    {{ $student->middle_name }}
                    {{ $student->last_name }}
                </h3>

                <p class="text-muted"> {{ $student->student_id }} </p>

                @if($student->status)

                    <span class="badge bg-success"> Active </span>

                @else

                    <span class="badge bg-danger"> Inactive </span>

                @endif

            </div>

        </div>

    </div>


    <!-- Student Information -->
    <div class="col-md-8">

        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <h5 class="mb-0">  Personal Information </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <strong>First Name</strong>

                        <p> {{ $student->first_name }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Last Name</strong>

                        <p> {{ $student->last_name }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Email</strong>

                        <p> {{ $student->email }} </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Phone</strong>

                        <p> {{ $student->phone ?: '-' }} </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Date of Birth</strong>

                        <p> {{ $student->date_of_birth ?: '-' }} </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Gender</strong>

                        <p> {{ $student->gender ?: '-' }} </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- Address -->
        <div class="card shadow-sm mb-4">

            <div class="card-header">

                <h5 class="mb-0"> Address</h5>

            </div>

            <div class="card-body">

                <p><strong>Address:</strong>{{ $student->address ?: '-' }}</p>

                <p><strong>City:</strong>{{ $student->city ?: '-' }}</p>

                <p> <strong>Country:</strong> {{ $student->country ?: '-' }}</p>

            </div>

        </div>


        <!-- Academic Information -->
        <div class="card shadow-sm">

            <div class="card-header">

                <h5 class="mb-0"> Academic Information</h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">

                        <strong>Student ID</strong>

                        <p> {{ $student->student_id }} </p>

                    </div>

                    <div class="col-md-6">

                        <strong>Course</strong>

                        <p> {{ $student->course ?: '-' }}</p>

                    </div>

                    <div class="col-md-6">

                        <strong>Education</strong>

                        <p> {{ $student->education ?: '-' }} </p>

                    </div>

                    <div class="col-md-6">

                        <strong>Admission Date</strong>

                        <p>
                            {{ $student->admission_date ?: '-' }}
                        </p>

                    </div>

                </div>

            </div>
<!-- yousaf put new module for pdf show -->
<!-- Student PDF Document -->
<div class="card shadow-sm mt-4">

    <div class="card-header">
        <h5 class="mb-0">Student Document</h5>
    </div>

    <div class="card-body">

        @if($student->student_pdf)

            <p class="mb-3">
                <strong>Uploaded PDF:</strong>
                {{ basename($student->student_pdf) }}
            </p>

            <a
                href="{{ asset('storage/' . $student->student_pdf) }}"
                target="_blank"
                class="btn btn-primary"
            >
                View PDF
            </a>

            <a
                href="{{ asset('storage/' . $student->student_pdf) }}"
                download
                class="btn btn-success"
            >
                Download Document
            </a>

        @else

            <p class="text-muted mb-0">
                No PDF document uploaded.
            </p>

        @endif

    </div>

</div>
<!-- end -->
</div>

    </div>

</div>

@endsection