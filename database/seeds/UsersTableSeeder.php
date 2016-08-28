<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
				[ 
						'id' => 1,
						'name' => 'abc',
						'phone' => '1233221',
						'job' => 'fdskfjdskf',
						'organization' => 'adfjkdfj',
						'location' => 'fdsfj',
						'email' => 'afjdsaf@gajg.com',
						'wechat_name' => 'fdsjafkdsa',
						'wechat_icon' => '/wechat_icons/icon.png',
						'open_id' => 'ffjdskafj',
						'gender' => 1 
				],
				[ 
						'id' => 2,
						'name' => 'abc',
						'phone' => '1233221',
						'job' => 'fdskfjdskf',
						'organization' => 'adfjkdfj',
						'location' => 'fdsfj',
						'email' => 'afjdsaf@gajg.com',
						'wechat_name' => 'fdsjafkdsa',
						'wechat_icon' => '/wechat_icons/icon.png',
						'open_id' => 'ffjdskafj',
						'gender' => 1 
				],
				[ 
						'id' => 3,
						'name' => 'abc',
						'phone' => '1233221',
						'job' => 'fdskfjdskf',
						'organization' => 'adfjkdfj',
						'location' => 'fdsfj',
						'email' => 'afjdsaf@gajg.com',
						'wechat_name' => 'fdsjafkdsa',
						'wechat_icon' => '/wechat_icons/icon.png',
						'open_id' => 'ffjdskafj',
						'gender' => 1 
				],
				[ 
						'id' => 4,
						'name' => 'abc',
						'phone' => '1233221',
						'job' => 'fdskfjdskf',
						'organization' => 'adfjkdfj',
						'location' => 'fdsfj',
						'email' => 'afjdsaf@gajg.com',
						'wechat_name' => 'fdsjafkdsa',
						'wechat_icon' => '/wechat_icons/icon.png',
						'open_id' => 'ffjdskafj',
						'gender' => 1 
				],
				[ 
						'id' => 5,
						'name' => 'abc',
						'phone' => '1233221',
						'job' => 'fdskfjdskf',
						'organization' => 'adfjkdfj',
						'location' => 'fdsfj',
						'email' => 'afjdsaf@gajg.com',
						'wechat_name' => 'fdsjafkdsa',
						'wechat_icon' => '/wechat_icons/icon.png',
						'open_id' => 'ffjdskafj',
						'gender' => 1 
				],
        ]);
    }
}
