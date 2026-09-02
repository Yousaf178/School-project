@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>Edit Student</h1>

    <a href="{{ route('students.show', $student->id) }}" class="btn btn-secondary"> Back to Profile </a>

</div>


<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-center bg-info align-items-center">

        <h4 class="mb-0">Edit Student Information</h4>

    </div>


    <div class="card-body">

        @if ($errors->any())

            <div class="alert alert-danger">

                <strong> Please fix the following errors:</strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">

            @csrf

            @method('PUT')

            <!-- Personal Information -->

            <h5 class="border-bottom pb-2 mb-3"> Personal Information </h5>


            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label"> First Name * </label>

                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                        value="{{ old('first_name', $student->first_name) }}" >

                    @error('first_name')

                        <div class="invalid-feedback">  {{ $message }} </div>

                    @enderror

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label"> Middle Name </label>

                    <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $student->middle_name) }}" >

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label"> Last Name * </label>

                    <input type="text" name="last_name"  class="form-control @error('last_name') is-invalid @enderror"
                        value="{{ old('last_name', $student->last_name) }}" >

                    @error('last_name')

                        <div class="invalid-feedback">  {{ $message }} </div>

                    @enderror

                </div>

            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label"> Email * </label>

                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $student->email) }}" >

                    @error('email')

                        <div class="invalid-feedback"> {{ $message }} </div>

                    @enderror

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label"> Phone </label>

                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" >

                </div>

            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label"> Date of Birth </label>

                    <input type="date" name="date_of_birth" class="form-control"
                        value="{{ old('date_of_birth', $student->date_of_birth) }}" >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label"> Gender </label>

                    <select name="gender" class="form-select" >

                        <option value=""> Select Gender</option>

                        <option value="Male"
                            {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }} >
                            Male
                        </option>

                        <option value="Female"
                            {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }} >
                            Female
                        </option>

                        <option value="Other"  {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }} >
                            Other
                        </option>

                    </select>

                </div>

            </div>


            <!-- Address -->

            <h5 class="border-bottom pb-2 mb-3 mt-3"> Address </h5>


            <div class="mb-3">

                <label class="form-label">  Address  </label>

                <textarea name="address" class="form-control" rows="3">{{ old('address', $student->address) }}</textarea>

            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        City
                    </label>

                    <input type="text" name="city" class="form-control" value="{{ old('city', $student->city) }}" >
                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label"> Country </label>

                    <input type="text"  name="country" class="form-control" value="{{ old('country', $student->country) }}">

                </div>

            </div>


            <!-- Academic -->

            <h5 class="border-bottom pb-2 mb-3 mt-3"> Academic Information </h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"> Student ID * </label>

                    <input type="text" name="student_id" class="form-control @error('student_id') is-invalid @enderror"
                        value="{{ old('student_id', $student->student_id) }}" >

                    @error('student_id')

                        <div class="invalid-feedback"> {{ $message }} </div>

                    @enderror

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label"> Course </label>

                    <input type="text" name="course" class="form-control" value="{{ old('course', $student->course) }}" >

                </div>

            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label"> Education</label>

                    <input type="text" name="education" class="form-control"
                        value="{{ old('education', $student->education) }}" >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label"> Admission Date </label>

                    <input type="date" name="admission_date" class="form-control"
                        value="{{ old('admission_date', $student->admission_date) }}" >

                </div>

            </div>


            <!-- Profile Image -->

            <h5 class="border-bottom pb-2 mb-3 mt-3"> Profile Image </h5>

 <div class="row">
            <div class="col-md-6 mb-3">

                @if($student->profile_image)

                    <div class="mb-3">
                      <img src="{{ asset('storage/' . $student->profile_image) }}" width="120" height="120"
                            class="rounded-circle" style="object-fit: cover;" alt="Current Profile" >

                    </div>

                @endif


                <label class="form-label"> Change Profile Image</label>

                <input type="file"  name="profile_image" class="form-control @error('profile_image') is-invalid @enderror"
                    accept="image/*"  >

                @error('profile_image')

                    <div class="invalid-feedback">{{ $message }}</div>

                @enderror

            </div>


            <!-- Status -->

            <div class="col-md-6 mb-3">

                <label class="form-label"> Status </label>

                <select name="status" class="form-select" >

                    <option value="1"
                        {{ old('status', $student->status) == 1 ? 'selected' : '' }} >
                        Active
                    </option>

                    <option value="0"
                        {{ old('status', $student->status) == 0 ? 'selected' : '' }} >
                        Inactive
                    </option>

                </select>

            </div>
</div>

            <!-- Buttons -->
<div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" >
                Update Student
            </button>

            <a href="{{ route('students.show', $student->id) }}" class="btn btn-secondary" >
                Cancel
            </a>
</div>
        </form>

    </div>

</div>

@endsection