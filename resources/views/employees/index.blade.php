<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Custom Simple CSS -->
    <style>
        /* General Body Styles */
        body {
            background-color: #f4f7fc;
            font-family: Arial, sans-serif;
            color: #333;
        }

        /* Centering Container */
        .container {
            margin-top: 30px;
            max-width: 90%;
            width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }

        /* Table Styles */
        .table {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        /* Table header color */
        .table thead {
            background-color: #007bff;
            color: white;
        }

        /* Table row hover effect */
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Image styling */
        .table td img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        /* Button Styling */
        .btn {
            display: inline-block;
            text-align: center;
            padding: 10px 15px; /* Added padding for better appearance */
            font-size: 14px; /* Uniform font size for all buttons */
            border-radius: 5px;
            margin: 5px; /* Add spacing between buttons */
            transition: all 0.3s ease; /* Smooth transition on hover */
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: black;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        /* Add New Employee Button Styling */
        .btn-add a {
            display: inline-block;
            text-align: center;
            width: auto; /* Adjust width for flexibility */
            font-size: 16px;
            padding: 12px 20px; /* Larger padding for the main button */
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-add a:hover {
            background-color: #0056b3;
            transform: scale(1.05); /* Slight zoom effect on hover */
        }

        /* Success alert */
        .alert-success {
            background-color: #28a745;
            color: white;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px;
        }
    </style>
    
</head>
<body>
    <div class="container mt-4">
        <h1>Employee List</h1>

        <!-- Add New Employee Button -->
        <div class="btn-add">
            <a href="{{ route('employees.create') }}" class="btn btn-primary btn-lg">Add New Employee</a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success" id="successMessage">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Hobbies</th> <!-- Added Hobbies Column -->
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->country_code }} {{ $employee->mobile }}</td>
                        <td>{{ $employee->gender }}</td>
                        <td>
                            @if ($employee->hobbies && count($employee->hobbies) > 0)
                                <!-- Display hobbies as a comma-separated string -->
                                {{ implode(', ', $employee->hobbies) }}
                            @else
                                No hobbies listed
                            @endif
                        </td>
                        
                        <td>
                            @if ($employee->photo)
                                <img src="{{ asset('storage/' . $employee->photo) }}" alt="Photo">
                            @else
                                No photo
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(function () {
                    successMessage.style.display = 'none';
                }, 3000); // Hide the success message after 3 seconds
            }
        });
    </script>
</body>
</html>
