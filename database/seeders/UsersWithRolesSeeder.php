<?php

namespace Database\Seeders;

use App\Models\MedicSchedule;
use App\Models\Schedule;
use App\Models\Specialty;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersWithRolesSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {

            $faker = Faker::create();
            $specialtyIds = Specialty::pluck('id_specialty')->toArray();

            // Define schedules
            $morningSchedules = Schedule::whereIn('days', ['Monday', 'Wednesday', 'Friday'])
                ->pluck('id_schedule')
                ->toArray();

            $afternoonSchedules = Schedule::whereIn('days', ['Tuesday', 'Thursday'])
                ->pluck('id_schedule')
                ->toArray();

            // Crear el usuario por defecto con rol super-admin
            $profile = Profile::create([
                'nid' => '0923717722',
                'first_name' => 'Juan',
                'last_name' => 'Nieto',
                'dob' => '1986-05-04',
                'phone' => '0995767405',
                'gender' => 'M',
                'country_id' => 63,
                'state_id' => 1031,
                'city_id' => 15342,
                'address' => 'Urb. Bosquetto Mz3350 V29',
                'user_register' => 1, // Ajustar según sea necesario
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user = User::create([
                'email' => 'jmnieto@utpl.edu.ec',
                'password' => Hash::make('prncs135'),
                'status' => 1,
                'user_register' => 1, // Ajustar según sea necesario
                'id_profile' => $profile->id_profile,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
            $user->assignRole($superAdminRole);

            // Crear el usuario por defecto con rol patient
            $profile = Profile::create([
                'nid' => $faker->unique()->numerify('##########'),
                'first_name' => 'Juan',
                'last_name' => 'Nieto',
                'dob' => '1986-05-04',
                'phone' => '0995767405',
                'gender' => 'M',
                'country_id' => 63,
                'state_id' => 1031,
                'city_id' => 15342,
                'address' => 'Urb. Bosquetto Mz3350 V29',
                'user_register' => 1, // Ajustar según sea necesario
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user = User::create([
                'email' => 'jnietos@live.com',
                'password' => Hash::make('prncs135'),
                'status' => 1,
                'user_register' => 1, // Ajustar según sea necesario
                'id_profile' => $profile->id_profile,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $patientRole = Role::firstOrCreate(['name' => 'patient']);
            $user->assignRole($patientRole);

            // Crear el usuario por defecto con rol medic
            $profile = Profile::create([
                'nid' => $faker->unique()->numerify('##########'),
                'first_name' => 'Juan',
                'last_name' => 'Nieto',
                'dob' => '1986-05-04',
                'phone' => '0995767405',
                'gender' => 'M',
                'country_id' => 63,
                'state_id' => 1031,
                'city_id' => 15342,
                'address' => 'Urb. Bosquetto Mz3350 V29',
                'user_register' => 1, // Ajustar según sea necesario
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user = User::create([
                'email' => 'juanxinho@gmail.com',
                'password' => Hash::make('prncs135'),
                'status' => 1,
                'user_register' => 1, // Ajustar según sea necesario
                'id_profile' => $profile->id_profile,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $medicRole = Role::firstOrCreate(['name' => 'medic']);
            $user->assignRole($medicRole);

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
        });
    }
}

