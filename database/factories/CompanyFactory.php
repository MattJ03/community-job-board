<?php

namespace Database\Factories;

use App\Models\company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'number_of_employees' => $this->faker->randomNumber(),
            'industry' => 'electrical engineering',
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $this->faker->password(),
        ];
    }
}
