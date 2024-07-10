<?php

namespace Database\Seeders;

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

            // Crear 50 usuarios adicionales con roles diferentes
            /*$faker = Faker::create();
            $roles = Role::all()->pluck('name')->toArray();

            foreach (range(1, 50) as $index) {
                $profile = Profile::create([
                    'nid' => $faker->unique()->numerify('##########'),
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'dob' => $faker->date(),
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

                // Asignar un rol aleatorio al usuario
                $randomRole = $faker->randomElement($roles);
                $user->assignRole($randomRole);
            }*/
        });
    }
}

