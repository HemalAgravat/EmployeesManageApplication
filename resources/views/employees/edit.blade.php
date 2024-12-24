<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom Creative CSS -->
    <style>
        /* Custom styles */
        body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin-top: 40px;
            margin-left: auto;
            margin-right: auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: 600;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea,
        select,
        input[type="file"] {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            width: 100%;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus,
        select:focus,
        textarea:focus {
            border: 1px solid #007bff;
            outline: none;
        }
        /* File Input Styling */
        input[type="file"] {
            padding: 5px;
        }
        /* Submit Button */
        .btn-submit {
            width: 100%;
            text-align: center;
        }
        /* Custom Button Styling */
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
            transform: translateY(-2px);
        }

        /* Success Message */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: none; /* Hide by default */
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Employee</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success" id="successMessage">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name) }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employee->email) }}" required>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <div class="input-group">
                    <select class="form-control" id="country_code" name="country_code" required>
                        <option value="">Select Country Code</option>
                        <option value="+1" {{ old('country_code', $employee->country_code) == '+1' ? 'selected' : '' }}>+1 (USA)</option>
                        <option value="+44" {{ old('country_code', $employee->country_code) == '+44' ? 'selected' : '' }}>+44 (UK)</option>
                        <option value="+91" {{ old('country_code', $employee->country_code) == '+91' ? 'selected' : '' }}>+91 (India)</option>
                        <option value="+61" {{ old('country_code', $employee->country_code) == '+61' ? 'selected' : '' }}>+61 (Australia)</option>
                    </select>
                    <input type="number" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $employee->mobile) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="4" required>{{ old('address', $employee->address) }}</textarea>
            </div>

            <div class="form-group">
                <label>Gender</label><br>
                <input type="radio" id="male" name="gender" value="Male" {{ old('gender', $employee->gender) == 'Male' ? 'checked' : '' }} required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="Female" {{ old('gender', $employee->gender) == 'Female' ? 'checked' : '' }} required>
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="Other" {{ old('gender', $employee->gender) == 'Other' ? 'checked' : '' }} required>
                <label for="other">Other</label>
            </div>

            <div class="form-group">
                <label for="hobbies">Hobbies</label><br>
                <input type="checkbox" name="hobbies[]" value="Reading" 
                    {{ in_array('Reading', old('hobbies', json_decode($employee->hobbies, true)) ?? []) ? 'checked' : '' }}> Reading
                <input type="checkbox" name="hobbies[]" value="Traveling" 
                    {{ in_array('Traveling', old('hobbies', json_decode($employee->hobbies, true)) ?? []) ? 'checked' : '' }}> Traveling
                <input type="checkbox" name="hobbies[]" value="Sports" 
                    {{ in_array('Sports', old('hobbies', json_decode($employee->hobbies, true)) ?? []) ? 'checked' : '' }}> Sports
            </div>
            

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                @if ($employee->photo)
                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="Current Photo" width="50">
                @endif
            </div>

            <div class="btn-submit">
                <button type="submit" class="btn btn-success">Update Employee</button>
            </div>
        </form>
    </div>
</body>
</html>
