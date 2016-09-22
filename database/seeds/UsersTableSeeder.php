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
						'phone' => '111111',
						'job' => 'fdskfjdskf',
						'organization' => 'adfjkdfj',
						'location' => 'fdsfj',
						'email' => 'afjdsaf@gajg.com',
						'wechat_name' => 'fdsjafkdsa',
						'head_image_url' => '/wechat_icons/icon.png',
						'open_id' => 'ffjdskafj',
						'gender' => 1,
						'password' => bcrypt('111111'),
						'status' => 1,
				],
				[ 
						'id' => 2,
						'name' => 'abc',
						'phone' => '222222',
						'job' => 'fdskfjdskf',
						'organization' => 'adfjkdfj',
						'location' => 'fdsfj',
						'email' => 'afjdsaf@gajg.com',
						'wechat_name' => 'fdsjafkdsa',
						'head_image_url' => '/wechat_icons/icon.png',
						'open_id' => 'ffjdskafj',
						'gender' => 1,
						'password' => bcrypt('111111'),
						'status' => 1,
				],
				[ 
						'id' => 3,
						'name' => 'abc',
						'phone' => '333333',
						'job' => 'fdskfjdskf',
						'organization' => 'adfjkdfj',
						'location' => 'fdsfj',
						'email' => 'afjdsaf@gajg.com',
						'wechat_name' => 'fdsjafkdsa',
						'head_image_url' => '/wechat_icons/icon.png',
						'open_id' => 'ffjdskafj',
						'gender' => 1,
						'password' => bcrypt('111111'), 
						'status' => 1,
				],
				[ 
						'id' => 4,
						'name' => 'abc',
						'phone' => '444444',
						'job' => 'fdskfjdskf',
						'organization' => 'adfjkdfj',
						'location' => 'fdsfj',
						'email' => 'afjdsaf@gajg.com',
						'wechat_name' => 'fdsjafkdsa',
						'head_image_url' => '/wechat_icons/icon.png',
						'open_id' => 'ffjdskafj',
						'gender' => 1,
						'password' => bcrypt('111111'), 
						'status' => 1,
				],
				[ 
						'id' => 5,
						'name' => 'abc',
						'phone' => '555555',
						'job' => 'fdskfjdskf',
						'organization' => 'adfjkdfj',
						'location' => 'fdsfj',
						'email' => 'afjdsaf@gajg.com',
						'wechat_name' => 'fdsjafkdsa',
						'head_image_url' => '/wechat_icons/icon.png',
						'open_id' => 'ffjdskafj',
						'gender' => 1,
						'password' => bcrypt('111111'), 
						'status' => 1,
				],
        		[
		        		'id' => 6,
		        		'name' => 'abc',
		        		'phone' => '666666',
		        		'job' => 'fdskfjdskf',
		        		'organization' => 'adfjkdfj',
		        		'location' => 'fdsfj',
		        		'email' => 'afjdsaf@gajg.com',
		        		'wechat_name' => 'fdsjafkdsa',
		        		'head_image_url' => '/wechat_icons/icon.png',
		        		'open_id' => 'ffjdskafj',
		        		'gender' => 1,
		        		'password' => bcrypt('111111'),
		        		'status' => 0,
        		],
        ]);
    }
}
