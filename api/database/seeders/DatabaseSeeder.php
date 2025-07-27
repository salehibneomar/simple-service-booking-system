<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\AdminFactory;
use Database\Factories\CustomerFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!User::where('email', 'admin@example.com')->exists()) {
            AdminFactory::new()->create();
        }

        CustomerFactory::new()->count(50)->create();
    }
}
