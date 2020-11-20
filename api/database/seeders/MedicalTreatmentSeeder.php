<?php

namespace Database\Seeders;


use App\Models\Medical_treatment;
use Illuminate\Database\Seeder;

class MedicalTreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Medical_treatment::factory(20)->create();
    }
}
