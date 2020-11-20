<?php

namespace Database\Seeders;

use App\Models\Waiting_list;
use Illuminate\Database\Seeder;

class WaitingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Waiting_list::factory(20)->create();
    }
}
