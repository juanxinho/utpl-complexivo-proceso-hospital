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
        $scheduleIds = Schedule::pluck('id_schedule')->toArray();

        // Create 50 Medic Users with different Specialties
        foreach (range(1, 50) as $index) {
            $profile = Profile::create([
                'nid' => $faker->unique()->numerify('##########'),
                'first_name' => $faker->firstName . ' M' . $index,
                'last_name' => $faker->lastName,
                'dob' => $faker->date(),
                'phone' => $faker->unique()->numerify('##########'),//$faker->phoneNumber,
                'gender' => $faker->randomElement(['M', 'F']),
                'status' => 1,
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
                $medicSchedules = [];
                foreach (range(1, 2) as $i) { // Adjust the range to assign more schedules if needed
                    $medicSchedules[] = [
                        'id_medic' => $user->id,
                        'id_specialty' => $specialtyId,
                        'id_schedule' => $scheduleIds[array_rand($scheduleIds)],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                MedicSchedule::insert($medicSchedules);
            }
        }
    }
}
