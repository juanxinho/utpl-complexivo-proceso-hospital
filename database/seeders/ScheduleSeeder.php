<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Day;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        // Define default schedule times
        $defaultSchedules = [
            ['start' => '09:00', 'end' => '12:00'],
            ['start' => '16:00', 'end' => '18:00'],
        ];

        // Define days of the week (Monday to Friday)
        $days = Day::all();

        // Define appointment duration in minutes
        $appointmentDuration = 30;

        // Get all doctors (assuming doctors have the 'medic' role)

        foreach ($days as $day) {
            foreach ($defaultSchedules as $schedule) {
                $startTime = Carbon::parse($schedule['start']);
                $endTime = Carbon::parse($schedule['end']);

                while ($startTime->lt($endTime)) {
                    $timeRange = $startTime->format('H:i') . ' - ' . $startTime->copy()->addMinutes($appointmentDuration)->format('H:i');

                    DB::table('schedule')->insert([
                        'day_id' => $day->id,
                        'time_range' => $timeRange,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Increment start time by appointment duration
                    $startTime->addMinutes($appointmentDuration);
                }
            }
        }
    }
}
