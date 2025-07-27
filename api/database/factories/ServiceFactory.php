<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\ServiceStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = date('Y');
        $start = "$year-01-01";
        $end = "$year-12-31";

        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->optional()->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(ServiceStatus::values()),
            'timeline' => $this->faker->date('Y-m-d', $this->faker->dateTimeBetween($start, $end)),
        ];
    }
}
