<?php

	namespace Database\Seeders;

	use App\Models\User; // tambahkan
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	use Illuminate\Support\Facades\Hash;  //tambahkan hash

	class UserSeeder extends Seeder
	{
		public function run(): void
		{
			$users = [
				[
					'username'=>'admin',
					'name'=>'Administrator',
					'email'=>'admin@gmail.com',
					'level'=>'admin',
					'password'=>Hash::make('123456')
				],
			

			];

			foreach ($users as $key => $value) {
				User::create($value);
			}
		}
	}
