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
            'firstname' => 'Adrian',
            'MI' => 'B',
            'lastname' => 'Dy',
            'email' => 'Kibsimba22@gmail.com',
            'password' => bcrypt('adrian'),
         	'mobile' => '09158649079',
        	'address' => 'Maria Luisa Estate Park Paseo John #25 Cebu City',
            'role_type' => 'ADMIN',
        ]);
    }
}
