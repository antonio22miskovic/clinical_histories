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
            UserSeeder::class,
            SpecialistSeeder::class,
            SpecialistUsersPivotSeeder::class,
            PatientSeeder::class,
            MedicalRecordSeeder::class,
            MedicalConsultationSeeder::class,
            DiseaseSeeder::class,
            DiagnosiSeeder::class,
            DiagnosiDiseasesPivotSeeder::class,
            MedicalTreatmentSeeder::class,
            QuotaSeeder::class,
            WaitingListSeeder::class

        ]);
    }
}
