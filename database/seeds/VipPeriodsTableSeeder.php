<?php

use Illuminate\Database\Seeder;

class VipPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vip_periods')->insert([
        		[ 
						'id' => 1,
						'start_date' => '2015-08-01',
						'end_date' => '2016-08-01',
						'vip_order_id' => 1,
						'user_id' => 1 
				],
				[ 
						'id' => 2,
						'start_date' => '2016-08-01',
						'end_date' => '2017-08-01',
						'vip_order_id' => 2,
						'user_id' => 1 
				],
				[ 
						'id' => 3,
						'start_date' => '2015-08-01',
						'end_date' => '2016-08-01',
						'vip_order_id' => 2,
						'user_id' => 2 
				],
				[ 
						'id' => 4,
						'start_date' => '2016-08-01',
						'end_date' => '2017-08-01',
						'vip_order_id' => 2,
						'user_id' => 3 
				],
				[ 
						'id' => 5,
						'start_date' => '2016-08-01',
						'end_date' => '2017-08-01',
						'vip_order_id' => 2,
						'user_id' => 4 
				]
        ]);
    }
}
