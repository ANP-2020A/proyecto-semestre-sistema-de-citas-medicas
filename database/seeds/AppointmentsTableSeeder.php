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
        // Vaciar la tabla articles.
        Appointment::truncate();
        $faker = \Faker\Factory::create();

        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear artículos en su nombre
        $users = App\User::all();
        foreach ($users as $user) {
            //iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123456']);
            // Y ahora con este usuario creamos algunos articulos
            $num_appointments = 10;
            for ($j = 0; $j < $num_appointments; $j++) {
                Appointment::create([
                    'datetime'=> $faker->date('Y-m-d'),
                    'description'=> $faker->paragraph,
                    'status'=> 'Pendiente',
                    'time'=> $faker->time('H:i:s'),
                ]);
            }
        }
    }
}
