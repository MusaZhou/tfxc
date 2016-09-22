<?php

use Illuminate\Database\Seeder;

class ActivityOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activity_orders')->insert([
        	[ 
						'id' => 1,
						'price' => '14.00',
						'user_id' => 1,
						'activity_id' => 1,
						'payment_time' => '2016-08-28 12:00:00',
						'note' => 'fsdaf',
						'payment_type_id' => 1,
        				'status' => 1,
        				'wxpay_type' => 1,
				],
				[ 
						'id' => 2,
						'price' => '14.00',
						'user_id' => 1,
						'activity_id' => 2,
						'payment_time' => '2016-08-28 12:00:00',
						'note' => 'fsdaf',
						'payment_type_id' => 2,
						'status' => 2,
						'wxpay_type' => 1,
				],
				[ 
						'id' => 3,
						'price' => '14.00',
						'user_id' => 1,
						'activity_id' => 3,
						'payment_time' => '2016-08-28 12:00:00',
						'note' => 'fsdaf',
						'payment_type_id' => 3,
						'status' => 2,
						'wxpay_type' => 1,
				],
				[ 
						'id' => 4,
						'price' => '14.00',
						'user_id' => 1,
						'activity_id' => 1,
						'payment_time' => '2016-08-28 12:00:00',
						'note' => 'fsdaf',
						'payment_type_id' => 1,
						'status' => 2,
						'wxpay_type' => 2,
				],
        		
        ]);
    }
}
