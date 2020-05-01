<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            DB::table('rekenings')->insert([
                'user_id' => $i,
                'no_rekening' => $faker->creditCardNumber,
                'pin' => 1234,
                'saldo' => $faker->numberBetween(1000, 9000),
            ]);
        }
    }
}
