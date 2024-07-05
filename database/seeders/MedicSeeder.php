<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Specialty;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class MedicSeeder extends Seeder
{
    public function run()
    {
        // Create Role 'medic' if it doesn't exist
        if (!Role::where('name', 'medic')->exists()) {
            Role::create(['name' => 'medic']);
        }

        // Create Specialties if they don't exist
        /*$specialties = [
            'Cardiology', 'Dermatology', 'Emergency Medicine', 'Endocrinology',
            'Gastroenterology', 'Geriatrics', 'Hematology', 'Infectious Disease',
            'Nephrology', 'Neurology', 'Obstetrics and Gynecology', 'Oncology',
            'Ophthalmology', 'Orthopedics', 'Otolaryngology', 'Pathology',
            'Pediatrics', 'Physical Medicine and Rehabilitation', 'Psychiatry',
            'Pulmonology', 'Radiology', 'Rheumatology', 'Surgery', 'Urology'
        ];

        foreach ($specialties as $specialtyName) {
            Specialty::firstOrCreate(['name' => $specialtyName]);
        }*/

        $specialtyIds = Specialty::pluck('id_specialty')->toArray();

        // Create 50 Medic Users with different Specialties
        for ($i = 1; $i <= 50; $i++) {
            $profile = Profile::create([
                'first_name' => 'Medic' . $i,
                'last_name' => 'User' . $i,
                'nid' => '123456789' . $i,
                'phone' => '09999999' . $i,
                'gender' => 'M',
                'dob' => now()->subYears(30)->toDateString(),
                'status' => 1,
                'user_register' => 1, // Assuming the admin user id is 1
            ]);

            $user = User::create([
                'email' => 'medic' . $i . '@example.com',
                'password' => Hash::make('password'),
                'id_profile' => $profile->id,
                'status' => 1,
                'user_register' => 1, // Assuming the admin user id is 1
            ]);

            $user->assignRole('medic');

            // Assign random specialties to each medic
            $user->specialties()->sync(array_rand(array_flip($specialtyIds), rand(1, 3)));
        }
    }
}
