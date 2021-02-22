<?php

namespace Database\Seeders;

use App\Models\Antecedente;
use Illuminate\Database\Seeder;

class AntecedenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Antecedente::factory(50)->create();
    }
}
