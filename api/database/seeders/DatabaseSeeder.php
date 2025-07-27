<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\AdminFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
    }
}
