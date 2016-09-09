<?php

use Illuminate\Database\Seeder;

class ConstantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('constants')->insert(['id' => 1, 'vip_price' => 100]);
    }
}
