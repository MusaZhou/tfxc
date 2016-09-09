<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call ( AdminsTableSeeder::class );
		$this->call ( UsersTableSeeder::class );
		$this->call ( PaymentTypesTableSeeder::class );
		$this->call ( VipOrdersTableSeeder::class );
		$this->call ( VipPeriodsTableSeeder::class );
		$this->call ( ActivitiesTableSeeder::class );
		$this->call ( ActivityOrdersTableSeeder::class );
		$this->call (ConstantsTableSeeder::class);
    }
}
