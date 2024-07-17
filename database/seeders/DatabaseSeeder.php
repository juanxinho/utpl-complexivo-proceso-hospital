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
            StockSeeder::class,
            DaySeeder::class,
            ScheduleSeeder::class,
            RolesAndPermissionsSeeder::class,
            SpecialtiesSeeder::class,
            DiagnosticsSeeder::class,
            CountryStateCityTableSeeder::class,
            UsersWithRolesSeeder::class,
            PatientSeeder::class,
            MedicSeeder::class,
            AppointmentSeeder::class,
            MedicalTests::class,
            RoomSeeder::class,
            AssignRoomsSeeder::class,
        ]);
    }
}
