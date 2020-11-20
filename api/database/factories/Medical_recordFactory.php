<?php

namespace Database\Factories;

use App\Models\Medical_record;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class Medical_recordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medical_record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => Patient::all()->random()->id
        ];
    }
}
