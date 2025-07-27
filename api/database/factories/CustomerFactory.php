<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\UserRole;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->userName() .mt_rand(10000, 99999) . '@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'role' => UserRole::CUSTOMER,
            'remember_token' => Str::random(10),
        ];
    }
}
