<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Persona;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersWithRolesSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            // Crear el usuario por defecto con rol super-admin
            $persona = Persona::create([
                'cedula' => '0923717722',
                'nombres' => 'Juan',
                'apellidos' => 'Nieto',
                'fecha_nacimiento' => '1985-04-05',
                'telefono' => '0995767405',
                'sexo' => 'M',
                'estado' => 1,
                'usuario_registro' => 1, // Ajustar según sea necesario
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user = User::create([
                'email' => 'jmnieto@utpl.edu.ec',
                'password' => Hash::make('prncs135'),
                'estado' => 1,
                'usuario_registro' => 1, // Ajustar según sea necesario
                'idpersona' => $persona->idpersona,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
            $user->assignRole($superAdminRole);

            // Crear 50 usuarios adicionales con roles diferentes
            $faker = Faker::create();
            $roles = Role::all()->pluck('name')->toArray();

            foreach (range(1, 50) as $index) {
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

                // Asignar un rol aleatorio al usuario
                $randomRole = $faker->randomElement($roles);
                $user->assignRole($randomRole);
            }
        });
    }
}

