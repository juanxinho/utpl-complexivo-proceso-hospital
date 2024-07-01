<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PatientSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            // Crear 25 usuarios adicionales con rol patient
            $faker = Faker::create();
            $roles = Role::all()->pluck('name')->toArray();

            foreach (range(1, 25) as $index) {
                $profile = Profile::create([
                    'nid' => $faker->unique()->numerify('##########'),
                    'first_name' => $faker->firstName,
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

                // Asignar el rol patient
                $patientRole = Role::firstOrCreate(['name' => 'patient']);
                $user->assignRole($patientRole);
            }
        });
    }
}

