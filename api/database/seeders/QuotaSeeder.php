<?php

namespace Database\Seeders;

use App\Models\Quota;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class QuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quota::create([

	        'quota' => 20,
	    	'specialist_id' => 1,
	    	'date' => Carbon::now()

        ]);

        Quota::create([

	        'quota' => 30,
	    	'specialist_id' => 2,
	    	'date' => Carbon::now()

        ]);

        Quota::create([

	        'quota' => 40,
	    	'specialist_id' => 3,
	    	'date' => Carbon::now()

        ]);

        Quota::create([

	        'quota' => 60,
	    	'specialist_id' => 4,
	    	'date' => Carbon::now()

        ]);

    }
}
