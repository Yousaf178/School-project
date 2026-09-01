<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>
    @yield('title', 'Student Management')
</title>

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>
</head>

<body class="bg-light">
<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <!-- Website Name -->

        <a
            class="navbar-brand"
            href="{{ route('students.index') }}"
        >
            Student Management
        </a>


        <!-- Right Side -->

        @auth

            <div class="d-flex align-items-center">

                <!-- Logged in user -->

                <span class="text-white me-3">

                    Welcome,
                    <strong>{{ auth()->user()->name }}</strong>

                </span>


                <!-- Add Student -->

                <a
                    href="{{ route('students.create') }}"
                    class="btn btn-primary me-2"
                >
                    Add Student
                </a>


                <!-- Logout -->

                <!-- <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="d-inline"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        Logout
                    </button>

                </form> -->

            </div>

        @endauth

    </div>

</nav>


<main class="container py-4">

    <!-- Success Message -->

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <!-- Error Message -->

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif


    @yield('content')

</main>
</body>

</html>
