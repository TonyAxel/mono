<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brand' => fake()->company(),
            'model' => fake()->regexify('[A-Za-z0-9]{10}'),
            'color' => fake()->colorName(),
            'number' => fake()->regexify('[A-Z]{1}[0-9]{3}[A-Z]{2}[10-999]{3}'),
            'check' => rand(0,1),
            'client_id' => Client::get()->random()->id
        ];
    }
}
