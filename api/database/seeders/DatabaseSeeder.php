<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            RolSeeder::class,
            SpecialistSeeder::class,
            UserSeeder::class,
            PatientSeeder::class,
            MedicalRecordSeeder::class,
            MedicalConsultationSeeder::class,
            DiagnosiSeeder::class,
            DiseaseSeeder::class,
            MedicalTreatmentSeeder::class,
            QuotaSeeder::class,
            WaitingListSeeder::class,
            AntecedenteSeeder::class

        ]);
    }
}
