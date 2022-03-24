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
        DB::table('users')->insert(
            [
            'name' => 'Hermiony Granger',
            'email' => 'hermiony@gmail.com',
            'phone' => '7896541230',
            'password' => Hash::make('123456'),
            'type' => 'Tn'
            ]
    );
    }
}
