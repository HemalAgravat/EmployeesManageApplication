<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->phoneNumber,
            'country_code' => $this->faker->countryCode,
            'address' => $this->faker->address,
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'hobbies' => json_encode($this->faker->words(3)),
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
