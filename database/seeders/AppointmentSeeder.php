<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MedicSchedule;
use App\Models\Appointment;
use App\Models\Schedule;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all medics and patients
        $medicSchedules = MedicSchedule::all()->pluck('id_medic_schedule')->toArray();
        $patients = User::role('patient')->pluck('id')->toArray();
        $validDays = Schedule::pluck('day_id')->unique()->toArray();

        // Function to get a random date on valid days
        $getRandomValidDate = function ($start, $end) use ($faker, $validDays) {
            $date = $faker->dateTimeBetween($start, $end);
            while (!in_array($date->format('N'), $validDays)) {
                $date = $faker->dateTimeBetween($start, $end);
            }
            return $date;
        };

        // Create random new appointments
        foreach (range(1, 10) as $index) {
            $medicScheduleId = MedicSchedule::inRandomOrder()->first()->id_medic_schedule;
            $patientId = User::role('patient')->inRandomOrder()->first()->id;
            Appointment::create([
                'user_register' => 1,
                'medic_schedule_id_medic_schedule' => $medicScheduleId,
                'id_patient' => $patientId,
                'service_date' => $getRandomValidDate('+1 week', '+1 month'),
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
                'service_date' => $getRandomValidDate('-1 month', '-1 week'),
                'status' => 'attended',
                'reason' => $faker->text,
                'next_control_date' => $faker->dateTimeBetween('+1 month', '+2 months'),
                'rating' => $faker->numberBetween(1, 5),
            ]);
        }

        // Create 3 future appointments for user ID 2 with medic user ID 3
        $futureDates = [
            $getRandomValidDate('now', '+1 week'),
            $getRandomValidDate('now', '+2 weeks'),
            $getRandomValidDate('now', '+3 weeks')
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
            $getRandomValidDate('-1 week', 'now'),
            $getRandomValidDate('-2 weeks', '-1 week'),
            $getRandomValidDate('-3 weeks', '-2 weeks')
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
