<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
            'name' => 'Ronald Weasley',
            'email' => 'ronald@gmail.com',
            'phone' => '7894561230',
            'password' => Hash::make('123456'),
            'type' => 'Ad'
        ]);
    }
}
