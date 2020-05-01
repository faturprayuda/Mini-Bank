<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 15; $i++) {
            DB::table('transaksis')->insert([
                'id_rekening' => $faker->numberBetween(1, 5),
                'no_transaksi' => $faker->numberBetween(1, 20),
                'date_transaksi' => $faker->dateTimeBetween('yesterday', 'now', 'Asia/Jakarta'),
                'total_transaksi' => $faker->numberBetween(1000, 9000),
            ]);
        }
    }
}
