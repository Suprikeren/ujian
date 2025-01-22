<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('tbl_suplier')->truncate();


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('tbl_suplier')->insert([
                'kode_suplier' => $faker->unique()->numerify('S###'),
                'nama_suplier' => $faker->company(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
