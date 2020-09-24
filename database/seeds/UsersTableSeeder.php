<?php


use App\User;
use App\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $faker = \Faker\Factory::create();

        $password = Hash::make('123456');

        User::create([
            'name' => 'Administrador',
            'lastname' => 'prueba',
            'birthdate' => '1993-07-29',
            'idcard' => '1721130993',
            'phone' => '987115138',
            'address' => 'Valle de los chillos',
            'email' => 'admin@prueba.com',
            'password' => $password,
            //'specialty_id' => '2',
            'status' => 'activo',
            'role' => 'ROLE_SUPERADMIN',
        ]);

        for ($i = 0; $i < 5; $i++) {
            $doctor = Doctor::create([
                'specialty' => $faker->word
            ]);

            $doctor->user()->create([
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'birthdate' => $faker->date("Y-m-d H:i:s"),
                'idcard' => $faker->numberBetween(1712654897, 1794879546),
                'phone' => $faker->numberBetween(911111111, 999999999),
                'address' => $faker->address,
                'email' => $faker->email,
                'password' => $password,
                'status' => 'inactivo',
            ]);
        }
        for ($i = 0; $i < 5; $i++) {


           User::create([
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'birthdate' => $faker->date("Y-m-d H:i:s"),
                'idcard' => $faker->numberBetween(1712654897, 1794879546),
                'phone' => $faker->numberBetween(911111111, 999999999),
                'address' => $faker->address,
                'email' => $faker->email,
                'password' => $password,
                'status' => 'inactivo',
            ]);


        }
    }
}

