<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Body Styling */
        body {
            background: linear-gradient(135deg, #ff7e5f, #feb47b); /* Warm sunset gradient */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        /* Form Container */
        .form-container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-out;
        }

        /* Form Fade In Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header Styling */
        h1 {
            text-align: center;
            color: #fff;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Form Styling */
        .form-group label {
            font-weight: 500;
            color: #333;
        }

        /* Input Fields */
        .form-control,
        .form-control-file,
        .input-group .form-control {
            width: 100%;
            max-width: 100%;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus,
        .input-group .form-control:focus {
            border-color: #ff7e5f;
            box-shadow: 0 0 8px rgba(255, 126, 95, 0.5);
        }

        /* Button Styling */
        .btn {
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            background-color: #ff7e5f;
            border-color: #ff7e5f;
        }

        .btn:hover {
            background-color: #feb47b;
            border-color: #feb47b;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 126, 95, 0.4);
        }

        /* Radio Buttons & Checkboxes */
        .form-check-inline {
            margin-right: 15px;
        }

        .form-check-label {
            font-weight: 500;
            color: #555;
        }

        /* Alert Box Styling */
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 8px;
            padding: 15px;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Input Group Styling */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group .form-control {
            flex: 1;
        }

        .input-group .form-control:first-child {
            max-width: 30%; /* Adjust country code dropdown width */
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .form-container {
                padding: 30px;
            }

            h1 {
                font-size: 26px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .btn {
                font-size: 14px;
                padding: 10px 16px;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Add New Employee</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- First Name -->
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- Mobile -->
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <div class="input-group">
                    <select class="form-control" id="country_code" name="country_code" required>
                        <option value="">Code</option>
                        <option value="+1" {{ old('country_code') == '+1' ? 'selected' : '' }}>+1</option>
                        <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>+44</option>
                        <option value="+91" {{ old('country_code') == '+91' ? 'selected' : '' }}>+91</option>
                        <option value="+61" {{ old('country_code') == '+61' ? 'selected' : '' }}>+61</option>
                    </select>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" required>
                </div>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
            </div>

            <!-- Gender -->
            <div class="form-group">
                <label>Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="male" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="female" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="other" name="gender" value="Other" {{ old('gender') == 'Other' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>

            <!-- Hobbies -->
            <div class="form-group">
                <label for="hobbies">Hobbies</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="reading" name="hobbies[]" value="Reading" {{ in_array('Reading', old('hobbies', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="reading">Reading</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="traveling" name="hobbies[]" value="Traveling" {{ in_array('Traveling', old('hobbies', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="traveling">Traveling</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sports" name="hobbies[]" value="Sports" {{ in_array('Sports', old('hobbies', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="sports">Sports</label>
                </div>
            </div>

            <!-- Photo -->
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block">Save Employee</button>
        </form>
    </div>
</body>
</html>
