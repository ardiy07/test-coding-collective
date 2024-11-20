<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Rendra',
            'email' => 'rendragituloh@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'inactive',
        ]);

        User::create([
            'name' => 'Khariz',
            'email' => 'Kharizajaah@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'inactive',
        ]);

        User::create([
            'name' => 'Joko',
            'email' => 'Jokoterdepan@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'inactive',
        ]);

        User::create([
            'name' => 'Mariyam',
            'email' => 'Maiyamyuk@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'inactive',
        ]);


    }
}
