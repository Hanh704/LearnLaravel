<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
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
            'email'=> $this->faker->email,
            'phone'=> $this->faker->numerify('##########'),
            'message'=> $this->faker->text,
            'user_id'=> User::factory(),
        ];
    }
}
