<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Student Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        h1 {
            text-align: center;
        }

        .section {
            margin-top: 20px;
        }

        .row {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .header {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>Student Profile</h1>

    <div class="section">

        <table>

            <tr>
                <td class="header">Student ID</td>
                <td>{{ $student->student_id }}</td>
            </tr>

            <tr>
                <td class="header">First Name</td>
                <td>{{ $student->first_name }}</td>
            </tr>

            <tr>
                <td class="header">Middle Name</td>
                <td>{{ $student->middle_name ?: '-' }}</td>
            </tr>

            <tr>
                <td class="header">Last Name</td>
                <td>{{ $student->last_name }}</td>
            </tr>

            <tr>
                <td class="header">Email</td>
                <td>{{ $student->email }}</td>
            </tr>

            <tr>
                <td class="header">Phone</td>
                <td>{{ $student->phone ?: '-' }}</td>
            </tr>

            <tr>
                <td class="header">Date of Birth</td>
                <td>{{ $student->date_of_birth ?: '-' }}</td>
            </tr>

            <tr>
                <td class="header">Gender</td>
                <td>{{ $student->gender ?: '-' }}</td>
            </tr>

            <tr>
                <td class="header">Address</td>
                <td>{{ $student->address ?: '-' }}</td>
            </tr>

            <tr>
                <td class="header">City</td>
                <td>{{ $student->city ?: '-' }}</td>
            </tr>

            <tr>
                <td class="header">Country</td>
                <td>{{ $student->country ?: '-' }}</td>
            </tr>

            <tr>
                <td class="header">Course</td>
                <td>{{ $student->course ?: '-' }}</td>
            </tr>

            <tr>
                <td class="header">Education</td>
                <td>{{ $student->education ?: '-' }}</td>
            </tr>

            <tr>
                <td class="header">Admission Date</td>
                <td>{{ $student->admission_date ?: '-' }}</td>
            </tr>

            <tr>
                <td class="header">Status</td>
                <td>
                    {{ $student->status ? 'Active' : 'Inactive' }}
                </td>
            </tr>

        </table>

    </div>

</body>
</html>