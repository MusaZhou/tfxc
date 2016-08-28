<?php

use Illuminate\Database\Seeder;

class VipOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vip_orders')->insert([
        		[ 
						'id' => 1,
						'price' => '12.00',
						'status' => 1,
						'user_id' => 1,
						'payment_time' => '2016-08-28',
						'payment_type_id' => 1 
				],
				[ 
						'id' => 2,
						'price' => '12.00',
						'status' => 1,
						'user_id' => 1,
						'payment_time' => '2016-08-28',
						'payment_type_id' => 2 
				],
				[ 
						'id' => 3,
						'price' => '12.00',
						'status' => 1,
						'user_id' => 2,
						'payment_time' => '2016-08-28',
						'payment_type_id' => 3 
				],
				[ 
						'id' => 4,
						'price' => '12.00',
						'status' => 1,
						'user_id' => 2,
						'payment_time' => '2016-08-28',
						'payment_type_id' => 1 
				],
				[ 
						'id' => 5,
						'price' => '12.00',
						'status' => 1,
						'user_id' => 3,
						'payment_time' => '2016-08-28',
						'payment_type_id' => 2 
				],
				[ 
						'id' => 6,
						'price' => '12.00',
						'status' => 1,
						'user_id' => 3,
						'payment_time' => '2016-08-28',
						'payment_type_id' => 3 
				],
        ]);
    }
}
