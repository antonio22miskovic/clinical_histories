<?php

namespace Database\Factories;

use App\Models\Diagnosi;
use App\Models\Disease;
use App\Models\Patient;
use App\Models\Specialist;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiseaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Disease::class;

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
            'specialist_id' => Specialist::all()->random()->id,
            'diagnosi_id' => Diagnosi::all()->random()->id,
        ];
    }
}
