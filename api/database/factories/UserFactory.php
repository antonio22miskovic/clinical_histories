<?php

namespace Database\Factories;

use App\Models\Specialist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'avatar' => 'defect.jpg',
            'email_verified_at' => now(),
            'password' => Hash::make(1234), // password
            'remember_token' => Str::random(10),
            'rol_id' => 2,
            'specialist_id' => Specialist::all()->random()->id,

        ];
    }
}
