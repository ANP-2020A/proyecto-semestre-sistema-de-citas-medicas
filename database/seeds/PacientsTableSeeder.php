<?php

use App\Pacients;
use Illuminate\Database\Seeder;

class PacientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla.
        Pacients::truncate();

        $faker = \Faker\Factory::create();

        //Crear artículos ficticios en la tabla
        for($i = 0; $i < 50; $i++) {
            Pacients::create([
                'nombre'=> $faker->firstName,
                'apellido'=> $faker->lastName,
                'fecha_nac_paciente'=> $faker->dateTimeBetween('-80 years','now',null),
                'cedula'=> $faker->numberBetween(1712654897,1794879546),
                'mail_paciente'=> $faker->email,
                'telefono_paciente'=> $faker->numberBetween(983160344,999999999),
            ]);
        }
    }
}
