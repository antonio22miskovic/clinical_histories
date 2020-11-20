<?php

namespace Database\Seeders;

use App\Models\Diagnosi;
use App\Models\DiagnosiDiseasesPivot;
use App\Models\Disease;
use Illuminate\Database\Seeder;

class DiagnosiDiseasesPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	for ($i=0; $i < 20; $i++) {

    		DiagnosiDiseasesPivot::create([
	        	'diagnosi_id' => Diagnosi::all()->random()->id,
	            'disease_id' => Disease::all()->random()->id
       	 	]);

    	}

    }
}
