<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    // Display the employee list
public function index()
{
    $employees = Employee::all();

    // Decode hobbies from JSON to array
    foreach ($employees as $employee) {
        $employee->hobbies = json_decode($employee->hobbies, true);
    }

    return view('employees.index', compact('employees'));
}


    // Show the form for creating a new employee
    public function create()
    {
        return view('employees.create');
    }

    // Store a new employee in the database
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'mobile' => 'required|numeric',
            'country_code' => 'required|string|max:5',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female,Other',
            'hobbies' => 'nullable|array',
            'hobbies.*' => 'string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->country_code = $request->country_code;
        $employee->address = $request->address;
        $employee->gender = $request->gender;
        $employee->hobbies = json_encode($request->hobbies);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $employee->photo = $path;
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    // Show the form for editing the specified employee
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    // Update the specified employee in the database
  // Update the specified employee in the database
public function update(Request $request, Employee $employee)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email,' . $employee->id,
        'mobile' => 'required|numeric',
        'country_code' => 'required|string|max:5',
        'address' => 'required|string',
        'gender' => 'required|in:Male,Female,Other',
        'hobbies' => 'nullable|array',
        'hobbies.*' => 'string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $employee->first_name = $request->first_name;
    $employee->last_name = $request->last_name;
    $employee->email = $request->email;
    $employee->mobile = $request->mobile;
    $employee->country_code = $request->country_code;
    $employee->address = $request->address;
    $employee->gender = $request->gender;
    
    // Handle hobbies as an array
    $employee->hobbies = json_encode($request->hobbies);  // Store hobbies as a JSON string

    if ($request->hasFile('photo')) {
        if ($employee->photo) {
            Storage::delete('public/' . $employee->photo);
        }
        $path = $request->file('photo')->store('photos', 'public');
        $employee->photo = $path;
    }

    $employee->save();

    return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
}


    // Remove the specified employee from the database
    public function destroy(Employee $employee)
    {
        if ($employee->photo) {
            Storage::delete('public/' . $employee->photo);
        }

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
