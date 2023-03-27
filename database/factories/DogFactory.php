<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dog>
 */
class DogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'data' => [
                'name' => fake()->name(),
                'age' => fake()->numberBetween(1, 20),
                'breed' => fake()->randomElement(['Labrador', 'Poodle', 'Pug', 'Bulldog', 'Beagle']),
            ]
        ];
    }
}
