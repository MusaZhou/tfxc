<?php

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->insert([
        	[ 
						'id' => 1,
						'name' => 'afdsaf',
						'description' => 'fsdaf',
						'price' => 12.00,
						'start_time' => '2016-08-28 12:00:00',
						'end_time' => '2016-08-30 12:00:00',
						'address' => 'fsadfjsdak',
        				'city_id' => '33',
				],
				[ 
						'id' => 2,
						'name' => 'afdsaf',
						'description' => 'fsdaf',
						'price' => 20.00,
						'start_time' => '2016-08-28 12:00:00',
						'end_time' => '2016-08-30 12:00:00',
						'address' => 'fsadfjsdak',
        				'city_id' => '33',
				],
				[ 
						'id' => 3,
						'name' => 'afdsaf',
						'description' => 'fsdaf',
						'price' => 12.00,
						'start_time' => '2016-08-28 12:00:00',
						'end_time' => '2016-08-30 12:00:00',
						'address' => 'fsadfjsdak',
        				'city_id' => '33',
				],
				[ 
						'id' => 4,
						'name' => 'afdsaf',
						'description' => 'fsdaf',
						'price' => 12.00,
						'start_time' => '2016-08-28 12:00:00',
						'end_time' => '2016-08-30 12:00:00',
						'address' => 'fsadfjsdak',
        				'city_id' => '33',
				],
				[ 
						'id' => 5,
						'name' => 'afdsaf',
						'description' => 'fsdaf',
						'price' => 12.00,
						'start_time' => '2016-08-28 12:00:00',
						'end_time' => '2016-08-30 12:00:00',
						'address' => 'fsadfjsdak',
        				'city_id' => '33',
				],
        ]);
    }
}
