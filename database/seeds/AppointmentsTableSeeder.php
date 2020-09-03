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

        $users = App\User::all();
        foreach ($users as $user) {
            //iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123456']);

            //$num_appointments = 5;
        $num_appointments = random_int(1, 5);
            for ($j = 0; $j < $num_appointments ; $j++){
                Appointment::create([
                    'datetime'=> $faker->date('Y-m-d'),
                    'description'=> $faker->paragraph,
                    'status'=> 'abierto',
                    'time'=> $faker->time('H:i:s'),

                ]);
            }
        }
    }
}
