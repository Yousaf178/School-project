@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-10">

        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-center bg-info align-items-center">
                <h4 class="mb-0">Add New Student</h4>
            </div>

            <div class="card-body">

                @if ($errors->any())
    
                    <div class="alert alert-danger">

                        <strong>Please fix the following errors:</strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <h5 class="border-bottom pb-2 mb-3">Personal Information </h5>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label"> First Name <small class="text-danger">*</small> </label>

                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                            value="{{ old('first_name') }}">

                            @error('first_name')
                                <div class="invalid-feedback"> {{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Middle Name</label>

                            <input type="text" name="middle_name" class="form-control"
                                value="{{ old('middle_name') }}" >

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label"> Last Name <small class="text-danger">*</small> </label>

                            <input type="text" name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" >

                            @error('last_name')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">  Email <small class="text-danger">*</small> </label>

                            <input type="email"  name="email"
    class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" >

@error('email')
    <div class="invalid-feedback">  {{ $message }} </div>
@enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">  Phone </label>

                            <input type="text" name="phone"  class="form-control"
                                value="{{ old('phone') }}" >

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label"> Date of Birth </label>

                            <input type="date" name="date_of_birth" class="form-control"
                                value="{{ old('date_of_birth') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Gender</label>

           <select name="gender" class="form-select @error('gender') is-invalid @enderror" >

            <option value=""> Select Gender </option>

            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }} >  Male </option>

            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }} > Female </option>

            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}> Other </option>

          </select>

                @error('gender')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror

                        </div>

                    </div>

                    <h5 class="border-bottom pb-2 mb-3 mt-3"> Address </h5>

                    <div class="mb-3">

                        <label class="form-label"> Address </label>

                        <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label"> City</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city') }}" >

                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"> Country </label>

                            <input type="text" name="country" class="form-control" value="{{ old('country') }}" >

                        </div>

                    </div>

                    <h5 class="border-bottom pb-2 mb-3 mt-3"> Academic Information </h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label"> Student ID <small class="text-danger">*</small> </label>

                            <input type="text" name="student_id" class="form-control @error('student_id') is-invalid @enderror" value="{{ old('student_id') }}">

@error('student_id')
    <div class="invalid-feedback"> {{ $message }} </div>
@enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label"> Course </label>

                            <input type="text" name="course" class="form-control" value="{{ old('course') }}" >
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label"> Education </label>

                            <input type="text" name="education" class="form-control" value="{{ old('education') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">  Admission Date </label>

                        <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date') }}" >

                        </div>

                    </div>
<!-- yousaf create pdf file  -->

<div class="col-md-6 mb-3">
    <label class="form-label">
        Student Document (PDF)
    </label>

    <input
        type="file"
        name="student_pdf"
        class="form-control @error('student_pdf') is-invalid @enderror"
        accept=".pdf,application/pdf"
    >

    @error('student_pdf')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

    <small class="text-danger">
        PDF only. Maximum 5MB.
    </small>
</div>
<!-- end -->


                <div class="row">
                    <h5 class="border-bottom pb-1 mb-3 mt-6"> Profile </h5>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">  Profile Image </label>

                        <input type="file" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror" accept="image/*" >

                        @error('profile_image')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror

                        <small class="text-danger"> JPG, JPEG, PNG or WEBP. Maximum 2MB. </small>

                        </div>

                        <div class="col-md-6 mb-3">

                        <label class="form-label"> Status </label>

                        <select name="status" class="form-select">
                            <option value="1"> Active </option>
                            <option value="0"> Inactive </option>
                        </select>

                    </div>
</div>
                    <div class="d-flex justify-content-between">

                        <button type="submit" class="btn btn-primary" > Save Student </button>

                        <a href="{{ route('students.index') }}" class="btn btn-secondary" > Cancel</a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection