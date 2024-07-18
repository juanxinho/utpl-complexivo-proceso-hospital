<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Specialty;
use App\Models\Schedule;
use App\Models\MedicSchedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Helpers\EcuadorianIdGenerator;

class MedicSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $specialtyIds = Specialty::pluck('id_specialty')->toArray();

        // Define schedules
        $morningSchedules = Schedule::whereIn('day_id', [1, 3, 5])
            ->pluck('id_schedule')
            ->toArray();

        $afternoonSchedules = Schedule::whereIn('day_id', [2, 4])
            ->pluck('id_schedule')
            ->toArray();

        // Create 10 Medic Users with different Specialties
        foreach (range(1, 10) as $index) {
            // Fetch data from randomuser.me
            $response = Http::get('https://randomuser.me/api/?nat=es&seed=ecuador' . $index)->json();
            $userData = $response['results'][0];

            $name = $userData['name']['first'] . '.' . $userData['name']['last'];
            $cleanedName = strtolower(preg_replace('/[^a-zA-Z0-9@.]/', '', $name));

            // Download a random image and store it
            $imageUrl = $userData['picture']['large'];
            $imageContents = file_get_contents($imageUrl);
            $imageName = 'profile_' . $cleanedName . '.jpg';
            Storage::put('public/profile-photos/' . $imageName, $imageContents);
            $imagePath = 'profile-photos/' . $imageName;



            $profile = Profile::create([
                'nid' => EcuadorianIdGenerator::generateId(),
                'first_name' => $userData['name']['first'],
                'last_name' => $userData['name']['last'],
                'dob' => date('Y-m-d', strtotime($userData['dob']['date'])),
                'country_id' => 63,
                'state_id' => 1033,
                'city_id' => 15368,
                'address' => $faker->address,
                'phone' => $faker->unique()->numerify('##########'),//$faker->phoneNumber,
                'gender' => $userData['gender'] == 'male' ? 'M' : 'F',
                'user_register' => 1, // Ajustar según sea necesario
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $user = User::create([
                'email' => $cleanedName . '@hiayoraloja.gob.ec',
                'password' => Hash::make('password'), // Cambiar según sea necesario
                'status' => 1,
                'user_register' => 1, // Ajustar según sea necesario
                'id_profile' => $profile->id_profile,
                'profile_photo_path' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $MedicRole = Role::firstOrCreate(['name' => 'medic']);
            $user->assignRole($MedicRole);

            // Assign random specialties to each medic
            $assignedSpecialties = array_rand(array_flip($specialtyIds), rand(1, 1));
            $user->specialties()->sync($assignedSpecialties);

            // Assign schedules to each medic's specialties
            foreach ((array)$assignedSpecialties as $specialtyId) {
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
