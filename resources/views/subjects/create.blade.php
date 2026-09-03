@extends('layouts.app')

@section('title', 'Add Subject')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>Add Subject</h1>

        <a href="{{ route('subjects.index') }}"
           class="btn btn-secondary">
            ← Back to Subjects
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('subjects.store') }}"
                  method="POST">

                @csrf

                {{-- Subject Name --}}
                <div class="mb-3">

                    <label class="form-label">
                        Subject Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="e.g. Mathematics"
                        required
                    >

                    @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Description --}}
                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Enter subject description..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- Status --}}
                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-select">

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


                {{-- Buttons --}}
                <button type="submit"
                        class="btn btn-success">
                    Save Subject
                </button>

                <a href="{{ route('subjects.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection