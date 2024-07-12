<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Specialty;
use App\Models\Schedule;
use App\Models\MedicSchedule;
use App\Models\Appointment;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all medics and patients
        $medicSchedules = MedicSchedule::all()->pluck('id_medic_schedule')->toArray();
        $patients = User::role('patient')->pluck('id')->toArray();

        // Create random new appointments
        foreach (range(1, 10) as $index) {
            $medicScheduleId = MedicSchedule::inRandomOrder()->first()->id_medic_schedule;
            $patientId = User::role('patient')->inRandomOrder()->first()->id;
            Appointment::create([
                'user_register' => 1,
                'medic_schedule_id_medic_schedule' => $medicScheduleId,
                'id_patient' => $patientId,
                'service_date' => $faker->dateTimeBetween('+1 week', '+1 month'),
                'status' => 'scheduled',
                'reason' => $faker->text,
                'next_control_date' => $faker->dateTimeBetween('+1 month', '+2 months'),
                'rating' => null,
            ]);
        }

        // Create random old appointments
        foreach (range(1, 10) as $index) {
            $medicScheduleId = MedicSchedule::inRandomOrder()->first()->id_medic_schedule;
            $patientId = User::role('patient')->inRandomOrder()->first()->id;
            Appointment::create([
                'user_register' => 1,
                'medic_schedule_id_medic_schedule' => $medicScheduleId,
                'id_patient' => $patientId,
                'service_date' => $faker->dateTimeBetween('-1 month', '-1 week'),
                'status' => 'attended',
                'reason' => $faker->text,
                'next_control_date' => $faker->dateTimeBetween('+1 month', '+2 months'),
                'rating' => $faker->numberBetween(1, 5),
            ]);
        }

        // Create 3 future appointments for user ID 2 with medic user ID 3
        $futureDates = [
            Carbon::now()->addWeek(),
            Carbon::now()->addWeeks(2),
            Carbon::now()->addWeeks(3)
        ];

        foreach ($futureDates as $date) {
            $medicScheduleId = MedicSchedule::where('id_medic', 3)->first()->id_medic_schedule ?? null;
            if ($medicScheduleId) {
                Appointment::create([
                    'user_register' => 1,
                    'medic_schedule_id_medic_schedule' => $medicScheduleId,
                    'id_patient' => 2,
                    'service_date' => $date,
                    'status' => 'scheduled',
                    'reason' => $faker->text,
                    'next_control_date' => $faker->dateTimeBetween('+1 month', '+2 months'),
                    'rating' => null,
                ]);
            }
        }

        // Create 3 past appointments for user ID 2 with medic user ID 3
        $pastDates = [
            Carbon::now()->subWeek(),
            Carbon::now()->subWeeks(2),
            Carbon::now()->subWeeks(3)
        ];

        foreach ($pastDates as $date) {
            $medicScheduleId = MedicSchedule::where('id_medic', 3)->first()->id_medic_schedule ?? null;
            if ($medicScheduleId) {
                Appointment::create([
                    'user_register' => 1,
                    'medic_schedule_id_medic_schedule' => $medicScheduleId,
                    'id_patient' => 2,
                    'service_date' => $date,
                    'status' => 'attended',
                    'reason' => $faker->text,
                    'next_control_date' => $faker->dateTimeBetween('+1 month', '+2 months'),
                    'rating' => $faker->numberBetween(1, 5),
                ]);
            }
        }
    }
}
