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
						'user_id' => 1,
        				'note' => 'abc',
				],
				[ 
						'id' => 2,
						'start_date' => '2016-08-01',
						'end_date' => '2017-08-01',
						'vip_order_id' => 2,
						'user_id' => 1,
        				'note' => 'abc',
				],
				[ 
						'id' => 3,
						'start_date' => '2015-08-01',
						'end_date' => '2016-08-01',
						'vip_order_id' => 3,
						'user_id' => 2,
        				'note' => 'abc', 
				],
				[ 
						'id' => 4,
						'start_date' => '2016-08-01',
						'end_date' => '2017-08-01',
						'vip_order_id' => 4,
						'user_id' => 3,
        				'note' => 'abc', 
				],
				[ 
						'id' => 5,
						'start_date' => '2016-08-01',
						'end_date' => '2017-08-01',
						'vip_order_id' => 5,
						'user_id' => 4,
        				'note' => 'abc', 
				]
        ]);
    }
}
