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
    	// User::factory(20)->create();
    	User::create([
    		'name' => 'Antonio Miskovic',
            'email' => 'admin@gmail.com',
            'avatar' => 'defect.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make(1234), // password
            'remember_token' => Str::random(10),
            'rol_id' => 1,
            'specialist_id' => null
    	]);

    	User::create([
    		'name' => 'Ramon Villalobos',
            'email' => 'villalobosantonio79@gmail.com',
            'avatar' => 'defect.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make(1234), // password
            'remember_token' => Str::random(10),
            'rol_id' => 2,
            'specialist_id' => 1
    	]);

        User::create([
            'name' => 'Maria Alejandra',
            'email' => 'maria@gmail.com',
            'avatar' => 'defect.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make(1234), // password
            'remember_token' => Str::random(10),
            'rol_id' => 2,
            'specialist_id' => 2
        ]);

        User::create([
            'name' => 'Jose Perez',
            'email' => 'jose@gmail.com',
            'avatar' => 'defect.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make(1234), // password
            'remember_token' => Str::random(10),
            'rol_id' => 2,
            'specialist_id' => 3
        ]);

        User::create([
            'name' => 'Angel Rodrigez',
            'email' => 'angel@gmail.com',
            'avatar' => 'defect.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make(1234), // password
            'remember_token' => Str::random(10),
            'rol_id' => 2,
            'specialist_id' => 4
        ]);
    }
}
