<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Specialty;
use App\Models\Schedule;
use App\Models\MedicSchedule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class MedicSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $specialtyIds = Specialty::pluck('id_specialty')->toArray();

        // Define schedules
        $morningSchedules = Schedule::whereIn('day_id', [1,3,5])
            ->pluck('id_schedule')
            ->toArray();

        $afternoonSchedules = Schedule::whereIn('day_id', [2,4])
            ->pluck('id_schedule')
            ->toArray();

        // Create 50 Medic Users with different Specialties
        foreach (range(1, 10) as $index) {
            $profile = Profile::create([
                'nid' => $faker->unique()->numerify('##########'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'dob' => $faker->date(),
                'country_id' => 63,
                'state_id' => 1033,
                'city_id' => 15368,
                'address' => $faker->address,
                'phone' => $faker->unique()->numerify('##########'),//$faker->phoneNumber,
                'gender' => $faker->randomElement(['M', 'F']),
                'user_register' => 1, // Ajustar según sea necesario
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user = User::create([
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Cambiar según sea necesario
                'status' => 1,
                'user_register' => 1, // Ajustar según sea necesario
                'id_profile' => $profile->id_profile,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $MedicRole = Role::firstOrCreate(['name' => 'medic']);
            $user->assignRole($MedicRole);

            // Assign random specialties to each medic
            $assignedSpecialties = array_rand(array_flip($specialtyIds), rand(1, 3));
            $user->specialties()->sync($assignedSpecialties);

            // Assign schedules to each medic's specialties
            foreach ((array) $assignedSpecialties as $specialtyId) {
                $scheduleType = rand(0, 1) ? $morningSchedules : $afternoonSchedules;
                foreach ($scheduleType as $scheduleId) {
                    MedicSchedule::create([
                        'id_medic' => $user->id,
                        'id_specialty' => $specialtyId,
                        'id_schedule' => $scheduleId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
