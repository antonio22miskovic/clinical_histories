<?php

namespace Database\Factories;

use App\Models\Quota;
use App\Models\Waiting_list;
use Illuminate\Database\Eloquent\Factories\Factory;

class Waiting_listFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Waiting_list::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'identification_card' => $this->faker->ean8,
            'quota_id' => Quota::all()->random()->id

        ];
    }
}
