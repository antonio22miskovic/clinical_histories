<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sex' => $this->faker->randomElement(['masculino','femenino']),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'ci' => $this->faker->ean8,
            'civil_status' => $this->faker->randomElement(['casado','soltero']),
            'birthdate' => $this->faker->dateTime($max = 'now', $timezone = null),
            'weight' =>  $this->faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 1)
        ];
    }
}
