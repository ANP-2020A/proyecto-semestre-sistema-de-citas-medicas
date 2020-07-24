<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(UsersTableSeeder::class);
        $this->call(PacientsTableSeeder::class);
        $this->call(SpecialitiesTableSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(AppointmentsTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
