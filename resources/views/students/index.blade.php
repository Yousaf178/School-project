@extends('layouts.app')

@section('title', 'Students')

@section('content')

<!-- Page Header -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>Students</h1>

    <div>
        <!-- Add Teacher Button -->
        <a href="{{ route('teachers.create') }}" class="btn btn-success me-2">
            + Add Teacher
        </a>

        <!-- Add Student Button -->
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            + Add Student
        </a>
    </div>

</div>





<!-- Search & Filters -->
<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form action="{{ route('students.index') }}" method="GET">
            <div class="row g-3">
                <!-- Search -->
                <div class="col-md-4">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-control" placeholder="Name, email, student ID or course..." value="{{ request('search') }}">
                </div>


                <!-- Course -->
                <div class="col-md-3">

                    <label class="form-label"> Course </label>

                    <select name="course" class="form-select">

                        <option value=""> All Courses </option>

                        @foreach($courses as $courseOption)

                            <option value="{{ $courseOption }}"
                                {{ request('course') == $courseOption ? 'selected' : '' }} >
                                {{ $courseOption }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- Gender -->
                <div class="col-md-2">

                    <label class="form-label"> Gender</label>

                    <select name="gender" class="form-select" >

                        <option value=""> All </option>

                        <option value="Male"
                            {{ request('gender') == 'Male' ? 'selected' : '' }} >
                            Male
                        </option>

                        <option
                            value="Female"
                            {{ request('gender') == 'Female' ? 'selected' : '' }}
                        >
                            Female
                        </option>

                        <option value="Other"
                            {{ request('gender') == 'Other' ? 'selected' : '' }} >
                            Other
                        </option>

                    </select>

                </div>


                <!-- Status -->
                <div class="col-md-2">

                    <label class="form-label"> Status </label>

                    <select name="status" class="form-select" >

                        <option value=""> All </option>

                        <option value="1"
                            {{ request('status') === '1' ? 'selected' : '' }} >
                            Active
                        </option>

                        <option value="0"
                            {{ request('status') === '0' ? 'selected' : '' }} >
                            Inactive
                        </option>

                    </select>

                </div>


                <!-- Filter Button -->
                <div class="col-md-1 d-flex align-items-end">

                    <button type="submit" class="btn btn-primary w-100" >
                        Filter
                    </button>

                </div>

            </div>


            <!-- Clear Button -->
            @if(
                request('search') ||
                request('course') ||
                request('gender') ||
                request('status') !== null
            )

                <div class="mt-3">

                    <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm" > Clear Filters </a>

                </div>

            @endif

        </form>

    </div>

</div>


<!-- Student Table -->
<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>
                        <th class="d-none">ID</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Age:</th>
                        <th>Student ID</th>
                        <th>Education</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th width="250"> Actions </th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($students as $student)

                        <tr>
                            <!-- ID -->
                            <td class="d-none"> {{ $student->id }} </td>

                            <!-- Profile Image -->
                            <!-- Profile Image -->
<!-- Profile Image -->
<td>
    @if($student->profile_image)

        <img
            src="{{ asset('storage/' . $student->profile_image) }}"
            width="60"
            height="60"
            class="rounded-circle"
            style="object-fit: cover; cursor: pointer;"
            alt="Profile"
            onclick="showImage('{{ asset('storage/' . $student->profile_image) }}')"
        >

    @else

        <span class="text-muted">No Image</span>

    @endif
</td>

                            <!-- Name -->
                            <td>

                                <strong>

                                    {{ $student->first_name }}

                                    @if($student->middle_name)
                                        {{ $student->middle_name }}
                                    @endif

                                    {{ $student->last_name }}

                                </strong>

                            </td>


                            <!-- Email -->
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->date_of_birth
            ? \Carbon\Carbon::parse($student->date_of_birth)->age . ' years'
            : 'N/A'
        }}</td>
                            <!-- Student ID double click to edit by yousaf -->
                            <td ondblclick="editStudentId(this)" data-student-id="{{ $student->id }}"   style="cursor: pointer;"  title="Double-click to edit" >
    <span class="student-id-text">{{ $student->student_id }}</span>
</td>


                            <!-- Course -->
                            <td ondblclick="editEducation(this)" data-student-id="{{ $student->id }}" style="cursor: pointer" title="Double-click to edit">
    <span class="education-text">{{ $student->education ?: 'N/A' }}</span>
</td>

<td>
    {{ $student->country }}
</td>
                            <!-- Status -->
                            <td>
                                @if($student->status)
                                    <span class="badge bg-success"> Active </span>

                                @else

                                    <span class="badge bg-danger"> Inactive</span>

                                @endif

                            </td>


                            <!-- Actions -->
                            <td>

                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info">
                                    View
                                </a>


                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>


                                <form action="{{ route('students.destroy', $student->id) }}"method="POST"
                                    class="d-inline" >

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this student?')" >
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-5" >

                                <h5>No students found </h5>

                                <p class="text-muted"> Try changing your search or filters.</p>

                                <a href="{{ route('students.create') }}" class="btn btn-primary" >
                                    Add First Student
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- Pagination -->
        <div class="mt-4">

            {{ $students->links() }}

        </div>

    </div>

</div>

@endsection

<!-- below script is for double click to edit studentID field by Yousaf -->
<script>
function editStudentId(cell) {

    // Prevent creating multiple inputs
    if (cell.querySelector('input')) {
        return;
    }

    let oldValue = cell.querySelector('.student-id-text').innerText.trim();

    let input = document.createElement('input');

    input.type = 'text';
    input.value = oldValue;

    input.className = 'form-control form-control-sm';

    cell.innerHTML = '';

    cell.appendChild(input);

    input.focus();

    // Select existing value
    input.select();

    // Save when Enter is pressed
    input.addEventListener('keydown', function(event) {

        if (event.key === 'Enter') {

            event.preventDefault();

            saveStudentId(cell, input.value, oldValue);

        }

        // Cancel when Escape is pressed
        if (event.key === 'Escape') {

            cell.innerHTML =
                '<span class="student-id-text">' +
                oldValue +
                '</span>';

        }

    });

    // Save when user clicks outside
    input.addEventListener('blur', function() {

        if (input.value !== oldValue) {

            saveStudentId(cell, input.value, oldValue);

        } else {

            cell.innerHTML =
                '<span class="student-id-text">' +
                oldValue +
                '</span>';

        }

    });

}


function saveStudentId(cell, newValue, oldValue) {

    newValue = newValue.trim();

    if (newValue === '') {

        alert('Student ID cannot be empty.');

        cell.innerHTML =
            '<span class="student-id-text">' +
            oldValue +
            '</span>';

        return;
    }


    let studentId = cell.dataset.studentId;


fetch('{{ url('/students') }}/' + studentId + '/student-id', {

        method: 'PUT',

        headers: {

            'Content-Type': 'application/json',

            'X-CSRF-TOKEN':
                document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            'Accept': 'application/json'

        },

        body: JSON.stringify({

            student_id: newValue

        })

    })

    .then(response => response.json())

    .then(data => {

        if (data.success) {

            cell.innerHTML =
                '<span class="student-id-text">' +
                data.student_id +
                '</span>';

        } else {

            alert(data.message || 'Unable to update Student ID.');

            cell.innerHTML =
                '<span class="student-id-text">' +
                oldValue +
                '</span>';

        }

    })

    .catch(error => {

        console.error(error);

        alert('Something went wrong.');

        cell.innerHTML =
            '<span class="student-id-text">' +
            oldValue +
            '</span>';

    });

}

</script>
<script type="text/javascript">
    function editEducation(cell) {

    // Prevent creating multiple inputs
    if (cell.querySelector('input')) {
        return;
    }

    let oldValue = cell.querySelector('.education-text').innerText.trim();

    let input = document.createElement('input');

    input.type = 'text';
    input.value = oldValue;

    input.className = 'form-control form-control-sm';

    cell.innerHTML = '';

    cell.appendChild(input);

    input.focus();

    // Select existing value
    input.select();

    // Save when Enter is pressed
    input.addEventListener('keydown', function(event) {

        if (event.key === 'Enter') {

            event.preventDefault();

            saveEducation(cell, input.value, oldValue);
        }

        // Cancel when Escape is pressed
        if (event.key === 'Escape') {

            cell.innerHTML =
                '<span class="education-text">' +
                oldValue +
                '</span>';
        }

    });

    // Save when user clicks outside
    input.addEventListener('blur', function() {

        if (input.value !== oldValue) {

            saveEducation(cell, input.value, oldValue);

        } else {

            cell.innerHTML =
                '<span class="education-text">' +
                oldValue +
                '</span>';
        }

    });

}


function saveEducation(cell, newValue, oldValue) {

    newValue = newValue.trim();

    let studentId = cell.dataset.studentId;

    fetch('{{ url('/students') }}/' + studentId + '/education', {

        method: 'PUT',

        headers: {

            'Content-Type': 'application/json',

            'X-CSRF-TOKEN':
                document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            'Accept': 'application/json'

        },

        body: JSON.stringify({

            education: newValue

        })

    })

    .then(response => response.json())

    .then(data => {

        if (data.success) {

            cell.innerHTML =
                '<span class="education-text">' +
                data.education +
                '</span>';

        } else {

            alert(data.message || 'Unable to update Education.');

            cell.innerHTML =
                '<span class="education-text">' +
                oldValue +
                '</span>';
        }

    })

    .catch(error => {

        console.error(error);

        alert('Something went wrong.');

        cell.innerHTML =
            '<span class="education-text">' +
            oldValue +
            '</span>';

    });

}
</script>
<!-- End by yousaf -->

<!-- Image Popup -->
<div id="imagePopup"
    style="
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        justify-content: center;
        align-items: center;
    "
    onclick="closeImage()">

    <div style="position: relative;" onclick="event.stopPropagation()">

        <button
            type="button"
            onclick="closeImage()"
            style="
                position: absolute;
                right: -15px;
                top: -15px;
                width: 35px;
                height: 35px;
                border: none;
                border-radius: 50%;
                background: white;
                font-size: 20px;
                cursor: pointer;
            ">
            &times;
        </button>

        <img
            id="popupImage"
            src=""
            alt="Profile Image"
            style="
                max-width: 90vw;
                max-height: 85vh;
                object-fit: contain;
                border-radius: 10px;
            ">
    </div>

</div>

<script>
function showImage(imageUrl) {
    document.getElementById('popupImage').src = imageUrl;
    document.getElementById('imagePopup').style.display = 'flex';
}

function closeImage() {
    document.getElementById('imagePopup').style.display = 'none';
    document.getElementById('popupImage').src = '';
}
</script>