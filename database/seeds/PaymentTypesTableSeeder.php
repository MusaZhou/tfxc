<?php

use Illuminate\Database\Seeder;

class PaymentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
				[ 
						'id' => 1,
						'name' => 'wechat' 
				],
				[ 
						'id' => 2,
						'name' => 'bank transfer' 
				],
				[ 
						'id' => 3,
						'name' => 'cash' 
				],
        ]);
    }
}
