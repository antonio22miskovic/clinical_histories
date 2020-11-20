<?php

namespace Database\Seeders;

use App\Models\Medical_record;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Medical_record::factory(30)->create();
    }
}
