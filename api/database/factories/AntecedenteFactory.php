<?php

namespace Database\Factories;

use App\Models\Antecedente;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class AntecedenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Antecedente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'patient_id' => Patient::all()->random()->id

        ];
    }
}
