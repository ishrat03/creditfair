<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++)
    	{ 
	        DB::table('employees')->insert([
	            'first_name' => Str::random(5),
	            'last_name' => Str::random(5),
	            'email' => Str::random(10).'@gmail.com',
	            'phone' => Str::random(10),
	            'company_id' => rand(1, 20)
	        ]);
    	}
    }
}
