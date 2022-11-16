<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 100; $i++ ){
            $gender = 'Мужской';
            if($i % 2 == 0) $gender = 'Мужской'; else $gender = 'Женский';
            DB::table('clients')->insert([
                'fio' => fake()->name(),
                'gender' => $gender,
                'phone' => fake()->phoneNumber(),
                'addres' => fake()->address(),
                'car_id' => rand(1,400)
            ]);
        }
    }
}
