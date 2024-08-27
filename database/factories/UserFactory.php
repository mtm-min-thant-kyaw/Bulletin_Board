<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'phone' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->optional()->address,
            'type' => $this->faker->numberBetween(0, 1),
            'dob' => $this->faker->optional()->date('Y-m-d'),
            'profile' => $this->faker->name('Profile'),
            'created_user_id' => $this->faker->numberBetween(1, 10),
            'updated_user_id' => $this->faker->numberBetween(1, 10),
            'deleted_user_id' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    // public function unverified(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}
