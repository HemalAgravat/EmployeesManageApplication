<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'employees';

    // Define the fillable attributes (mass-assignment protection)
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'country_code',
        'address',
        'gender',
        'hobbies',
        'photo'
    ];

    // Cast the 'hobbies' attribute to an array (since it's stored as JSON in the database)
    protected $casts = [
        'hobbies' => 'array',
    ];

    // Optionally, you can add mutators for better formatting or storing data
    // For example, storing the 'created_at' in a custom format
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
}
