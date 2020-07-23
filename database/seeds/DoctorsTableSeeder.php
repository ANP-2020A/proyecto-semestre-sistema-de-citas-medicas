<?php

use App\Doctor;
use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla.
        Doctor::truncate();

        $faker = \Faker\Factory::create();
        //Crear artículos ficticios en la tabla
        for($i = 0; $i < 50; $i++)

            Doctor::create([
                'nombre_doctor'=> $faker->firstName,
                'apellido_doctor'=> $faker->lastName,
                'mail_doctor'=> $faker->email,
                'ci_doctor'=> $faker->numberBetween(1712654897,1794879546),
                'telefono_doctor'=> $faker->numberBetween(983160344,999999999),
            ]);
        }
}
