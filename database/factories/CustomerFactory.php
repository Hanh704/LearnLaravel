<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> $this->faker->word,
            'avatar'=> $this->faker->word,
            'email'=> $this->faker->email,
            'phone'=> $this->faker->numerify('##########'),
            'address'=> $this->faker->text,
            'birthday'=> $this->faker->date,
        ];
    }
}
