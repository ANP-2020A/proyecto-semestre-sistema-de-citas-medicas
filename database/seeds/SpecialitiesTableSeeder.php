<?php

use App\Specialty;
use Illuminate\Database\Seeder;

class SpecialitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciamos la tabla categories
        Specialty::truncate();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            Specialty::create([
                'name' => $faker->word
            ]);
        }
    }
}
