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
        //
        DB::table('users')->insert([
        	'name' => 'Bùi Quốc Hoàn',
        	'email' => 'hoantest@gmail.com',
        	'password' => Hash::make('123'),
        	'ruler' => 1,
        	'status' => 1,
        ]);
    }
}
