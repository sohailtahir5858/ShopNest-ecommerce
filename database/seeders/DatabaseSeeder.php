<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\STR;
use Faker\Factory as Faker;



class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $list) {
            DB::table('customers')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'mobile' => $faker->numerify('##########'),
                'password' => $faker->password,
                'address' => $faker->address,
                'city' => $faker->city,
                'state' => STR::random(10),
                'company' => $faker->company,
                'zip' => $faker->numerify('######'),
                'status' => $faker->numberBetween(0, 1),
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),

            ]);
        }
    }
}
