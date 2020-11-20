<?php

namespace Database\Factories;

use App\Models\Diagnosi;
use App\Models\DiagnosiDiseasesPivot;
use App\Models\Disease;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiagnosiDiseasesPivotFcatory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DiagnosiDiseasesPivot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'diagnosi_id' => Diagnosi::all()->random()->id,
            'disease_id' => Disease::all()->random()->id
        ];
    }
}
