<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            SpecialtiesSeeder::class,
            CountryStateCityTableSeeder::class,
            UsersWithRolesSeeder::class,
            PatientSeeder::class,
            ScheduleSeeder::class,
            MedicSeeder::class,
            AppointmentSeeder::class,
            StockSeeder::class,
        ]);
    }
}
