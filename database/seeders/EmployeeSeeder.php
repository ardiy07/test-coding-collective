<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('employees')->insert([
            [
                'user_id' => 1,
                'city' => 'jogja',
                'dob' => '2011-11-11',
            ],
            [
                'user_id' => 2,
                'city' => 'bantul',
                'dob' => '2012-12-12',
            ],
            [
                'user_id' => 3,
                'city' => 'sleman',
                'dob' => '2010-10-10',
            ],
            [
                'user_id' => 4,
                'city' => 'gunung kidul',
                'dob' => '2009-9-9',
            ],
        ]);
    }
}
