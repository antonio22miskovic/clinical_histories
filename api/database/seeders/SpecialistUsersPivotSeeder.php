<?php

namespace Database\Seeders;

use App\Models\Specialist;
use App\Models\SpecialistUsersPivot;
use App\Models\User;
use Illuminate\Database\Seeder;

class SpecialistUsersPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 20; $i++) {

    		SpecialistUsersPivot::create([

	    		'user_id' => User::all()->random()->id,
	    		'specialist_id' => Specialist::all()->random()->id

    		]);

    	}
        // SpecialistUsersPivot::factory(10)->create();
    }
}
