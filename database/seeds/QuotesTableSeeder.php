<?php

use App\Quotes;
use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciar la tabla.
        Quotes::truncate();
        $faker = \Faker\Factory::create();

        // Crear citas ficticias en la tabla
        for($i = 0; $i < 10; $i++) {
            Quotes::create([
                'datetime'=> $faker->date('Y-m-d'),
                'description'=> $faker->paragraph,
                'state'=> $faker->state,
                ]);
        }
    }
}
