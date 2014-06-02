<?php

class UserTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();
		User::create(array(
			'email' => 'mali@q2metrics.com',
			'first_name' => 'Maaz',
			'last_name' => 'Ali',
			'total_minutes_worked' => 0,
			'password'=> Hash::make('first_password')
		));

		User::create(array(
			'email' => 'maaz_ali@outlook.com',
			'first_name' => 'Khan',
			'last_name' => 'Ali',
			'total_minutes_worked' => 0,
			'password'=> Hash::make('second_password')
		));


	}
}