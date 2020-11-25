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
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Miraz Hossain',
            'email' => 'admin@trustenterprise.com.bd',
            'phone' => '01719566930',
            'type' => 1,
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'image' => 'default.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
