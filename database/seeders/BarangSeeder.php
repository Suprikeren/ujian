<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('tbl_barang')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('tbl_barang')->insert([
                'kode_barang' => $faker->unique()->numerify('B###'),
                'nama_barang' => $faker->word(),
                'satuan'      => $faker->randomElement(['pcs', 'kg', 'liter']),
                'harga_beli'  => $faker->numberBetween(10000, 100000),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
