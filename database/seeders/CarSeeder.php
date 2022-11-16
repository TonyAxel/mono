<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 400; $i++ ){
            $number = Str::random(1) . rand(100,999) . Str::random(2) . rand(100, 999);
            DB::table('cars')->insert([
                'brand' => fake()->company(),
                'model' => Str::random(10),
                'color' => fake()->safeColorName(),
                'number' => Str::upper($number),
                'check' => rand(0,1)
            ]);
        }
    }
}
