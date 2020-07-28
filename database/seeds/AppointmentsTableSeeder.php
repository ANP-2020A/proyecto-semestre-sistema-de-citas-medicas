<?php
use App\Appointment;
use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla.
        Appointment::truncate();
        $faker = \Faker\Factory::create();

        // Crear citas ficticias en la tabla
        for($i = 0; $i < 10; $i++) {
            Appointment::create([
                'datetime'=> $faker->date('Y-m-d'),
                'description'=> $faker->paragraph,
                'status'=> 'Pendiente',
                'time'=> $faker->time('H:i:s'),
            ]);
        }
    }
}
