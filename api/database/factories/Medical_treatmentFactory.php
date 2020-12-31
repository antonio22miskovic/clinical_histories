<?php

namespace Database\Factories;

use App\Models\Diagnosi;
use App\Models\Disease;
use App\Models\Medical_treatment;
use Illuminate\Database\Eloquent\Factories\Factory;

class Medical_treatmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medical_treatment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->paragraph,
            'medicine' => $this->faker->name,
            'disease_id' => Disease::all()->random()->id,
        ];
    }
}
