<?php

namespace Database\Factories;

use App\Models\Specialist;
use App\Models\SpecialistUsersPivot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialistUsersPivotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecialistUsersPivot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'specialist_id' => Specialist::all()->random()->id
        ];
    }
}
