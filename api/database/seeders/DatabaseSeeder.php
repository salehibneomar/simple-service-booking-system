<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\AdminFactory;
use Database\Factories\CustomerFactory;
use Database\Factories\ServiceFactory;

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

        CustomerFactory::new()->count(10)->create();

        $chunkSize = 50;
        $total = 200;
        for ($i = 0; $i < $total; $i += $chunkSize) {
            ServiceFactory::new()->count($chunkSize)->create();
        }
    }
}
