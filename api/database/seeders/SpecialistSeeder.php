<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialist::create([
        	'name' => 'especialidad-1',
        	'description' => 'la especialidad numero 1 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        Specialist::create([
        	'name' => 'especialidad-2',
        	'description' => 'la especialidad numero 2 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        Specialist::create([
        	'name' => 'especialidad-3',
        	'description' => 'la especialidad numero 3 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        Specialist::create([
        	'name' => 'especialidad-4',
        	'description' => 'la especialidad numero 4 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        Specialist::create([
        	'name' => 'especialidad-5',
        	'description' => 'la especialidad numero 5 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        Specialist::create([
        	'name' => 'especialidad-6',
        	'description' => 'la especialidad numero 6 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        Specialist::create([
        	'name' => 'especialidad-7',
        	'description' => 'la especialidad numero 7 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        Specialist::create([
            'name' => 'especialidad-8',
            'description' => 'la especialidad numero 8 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);
    }
}
