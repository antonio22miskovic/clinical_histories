<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::factory(20)->create();
    	User::create([
    		'name' => 'Ramon Villalobos',
            'email' => 'villalobosantonio79@gmail.com',
            'avatar' => 'defect.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make(1234), // password
            'remember_token' => Str::random(10),
            'rol_id' => 2
    	]);
    	User::create([
    		'name' => 'Antonio Miskovic',
            'email' => 'antonio@gmail.com',
            'avatar' => 'defect.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make(1234), // password
            'remember_token' => Str::random(10),
            'rol_id' => 1
    	]);
    }
}
