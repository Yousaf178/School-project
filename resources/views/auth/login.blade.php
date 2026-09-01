<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<div class="container">

    <div
        class="row justify-content-center align-items-center"
        style="min-height: 100vh;"
    >

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center bg-dark text-white">

                    <h4 class="mb-0">
                        Student Management
                    </h4>

                </div>


                <div class="card-body p-4">

                    <h3 class="text-center mb-4">
                        Login
                    </h3>


                    @if ($errors->any())

                        <div class="alert alert-danger">

                            @foreach ($errors->all() as $error)

                                <div>
                                    {{ $error }}
                                </div>

                            @endforeach

                        </div>

                    @endif


                    <form
    action="{{ route('login.submit') }}"
    method="POST"
>

    @csrf

    <!-- Email -->

    <div class="mb-3">

        <label class="form-label">
            Email
        </label>

        <input
            type="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}"
            placeholder="Enter your email"
        >

        @error('email')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

        @enderror

    </div>


    <!-- Password -->

    <div class="mb-3">

        <label class="form-label">
            Password
        </label>

        <input
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Enter your password"
        >

        @error('password')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

        @enderror

    </div>


    <!-- Login Button -->

    <button
        type="submit"
        class="btn btn-primary w-100"
    >
        Login
    </button>

</form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>