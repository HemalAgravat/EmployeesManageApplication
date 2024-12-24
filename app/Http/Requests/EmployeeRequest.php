<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'country_code' => 'required|string',
            'mobile_number' => 'required|numeric|min:10',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:0,1,2',
            'hobbies' => 'required|array',
            'hobbies.*' => 'required|in:1,2,3,4,5', // Validate the hobbies checkboxes
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ];
    }
}
