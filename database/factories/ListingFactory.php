<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'title' => $this->faker->jobTitle(),
            'location' => $this->faker->city(),
            'years_of_experience' => $this->faker->numberBetween(1,20),
            'requirements' => $this->faker->text(),
            'description' => $this->faker->text(),
            'minimum_qualification' => 'Masters',
            'industry' => 'electronics',
            'work_from' => 'remote',
            'salary' => $this->faker->numberBetween(1,100),
            'hourly' => null,
            'status' => 'open',
            'views' => 0,
        ];
    }
}
