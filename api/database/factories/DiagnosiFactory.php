<?php

namespace Database\Factories;

use App\Models\Diagnosi;
use App\Models\Medical_consultation;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiagnosiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Diagnosi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'medical_consultation_id' => Medical_consultation::all()->random()->id,
        ];
    }
}
