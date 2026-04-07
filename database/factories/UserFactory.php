<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // v1: Auth theo zalo_id, chưa có OAuth / password.
            'zalo_id' => (string) Str::uuid(), // đảm bảo unique
            'name' => fake()->name(),
            'avatar' => null,
            'status' => 'active',
        ];
    }

    // Không có trạng thái email_verified/password ở v1.
}
