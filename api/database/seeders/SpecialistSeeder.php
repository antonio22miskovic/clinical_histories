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
        	'name' => 'Medicina General',
        	'description' => 'la especialidad numero 1 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        Specialist::create([
        	'name' => 'Pediatria',
        	'description' => 'la especialidad numero 2 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        Specialist::create([
        	'name' => 'Odontologia',
        	'description' => 'la especialidad numero 3 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        Specialist::create([
        	'name' => 'Ginecologia',
        	'description' => 'la especialidad numero 4 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        ]);

        // Specialist::create([
        // 	'name' => 'especialidad-5',
        // 	'description' => 'la especialidad numero 5 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        // ]);

        // Specialist::create([
        // 	'name' => 'especialidad-6',
        // 	'description' => 'la especialidad numero 6 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        // ]);

        // Specialist::create([
        // 	'name' => 'especialidad-7',
        // 	'description' => 'la especialidad numero 7 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        // ]);

        // Specialist::create([
        //     'name' => 'especialidad-8',
        //     'description' => 'la especialidad numero 8 escargada de tal cosa, para atender x pacientes, esto es una descripcion de las especialidades '
        // ]);
    }
}
