<?php

namespace Database\Seeders;

use App\Models\Medical_consultation;
use Illuminate\Database\Seeder;

class MedicalConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medical_consultation::factory(20)->create();
    }
}
