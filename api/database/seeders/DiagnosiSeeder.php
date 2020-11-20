<?php

namespace Database\Seeders;

use App\Models\Diagnosi;
use Illuminate\Database\Seeder;

class DiagnosiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Diagnosi::factory(22)->create();
    }
}
