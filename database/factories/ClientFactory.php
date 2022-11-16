<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $g = rand(0,1);
        $gender = '';
        if($g == 1) $gender = 'Мужской'; else $gender = 'Женский';
        return [
            'fio' => fake()->name(),
            'gender' => $gender,
            'phone' => fake()->phoneNumber(),
            'addres' => fake()->address()
        ];
    }
}
