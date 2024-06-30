<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Persona;
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
                $persona = Persona::create([
                    'cedula' => $faker->unique()->numerify('##########'),
                    'nombres' => $faker->firstName,
                    'apellidos' => $faker->lastName,
                    'fecha_nacimiento' => $faker->date(),
                    'telefono' => $faker->unique()->numerify('##########'),//$faker->phoneNumber,
                    'sexo' => $faker->randomElement(['M', 'F']),
                    'estado' => 1,
                    'usuario_registro' => 1, // Ajustar según sea necesario
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $user = User::create([
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('password'), // Cambiar según sea necesario
                    'estado' => 1,
                    'usuario_registro' => 1, // Ajustar según sea necesario
                    'idpersona' => $persona->idpersona,
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

