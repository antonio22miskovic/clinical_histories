<?php

namespace Database\Factories;

use App\Models\Medical_consultation;
use App\Models\Medical_record;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class Medical_consultationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medical_consultation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'medical_record_id' => Medical_record::all()->random()->id,
        ];
    }
}
