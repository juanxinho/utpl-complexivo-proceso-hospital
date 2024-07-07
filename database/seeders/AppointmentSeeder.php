<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\MedicSchedule;
use App\Models\User;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all medics and patients
        $medicSchedules = MedicSchedule::all()->pluck('id_medic_schedule')->toArray();
        $patients = User::role('patient')->pluck('id')->toArray();

        // Create 50 random new appointments
        foreach (range(1, 50) as $index) {
            Appointment::create([
                'user_register' => 1, // Assuming the user_register ID is 1, adjust as needed
                'medic_schedule_id_medic_schedule' => $faker->randomElement($medicSchedules),
                'id_patient' => $faker->randomElement($patients),
                'service_date' => $faker->dateTimeBetween('+1 week', '+1 month'),
                'status' => 'scheduled',
            ]);
        }

        // Create 50 random old appointments
        foreach (range(1, 50) as $index) {
            Appointment::create([
                'user_register' => 1, // Assuming the user_register ID is 1, adjust as needed
                'medic_schedule_id_medic_schedule' => $faker->randomElement($medicSchedules),
                'id_patient' => $faker->randomElement($patients),
                'service_date' => $faker->dateTimeBetween('-1 week', '-1 month'),
                'status' => 'attended',
            ]);
        }

        // Create 3 future appointments for user ID 2 with medic user ID 3
        $futureDates = [
            Carbon::now()->addWeek(),
            Carbon::now()->addWeeks(2),
            Carbon::now()->addWeeks(3)
        ];

        foreach ($futureDates as $date) {
            Appointment::create([
                'user_register' => 1,
                'medic_schedule_id_medic_schedule' => MedicSchedule::where('id_medic', 3)->first()->id_medic_schedule,
                'id_patient' => 2,
                'service_date' => $date,
                'status' => 'scheduled',
            ]);
        }

        // Create 3 past appointments for user ID 2 with medic user ID 3
        $pastDates = [
            Carbon::now()->subWeek(),
            Carbon::now()->subWeeks(2),
            Carbon::now()->subWeeks(3)
        ];

        foreach ($pastDates as $date) {
            Appointment::create([
                'user_register' => 1,
                'medic_schedule_id_medic_schedule' => MedicSchedule::where('id_medic', 3)->first()->id_medic_schedule,
                'id_patient' => 2,
                'service_date' => $date,
                'status' => 'attended',
            ]);
        }
    }
}
