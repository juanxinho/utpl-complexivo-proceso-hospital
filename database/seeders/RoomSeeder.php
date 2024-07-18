<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            ['code' => 'R001', 'name' => 'Consultorio 1', 'description' => 'Consultorio de Cardiología', 'location' => 'Planta Baja'],
            ['code' => 'R002', 'name' => 'Consultorio 2', 'description' => 'Consultorio de Neurología', 'location' => 'Planta Baja'],
            ['code' => 'R003', 'name' => 'Consultorio 3', 'description' => 'Consultorio de Pediatría', 'location' => 'Planta Baja'],
            ['code' => 'R004', 'name' => 'Consultorio 4', 'description' => 'Consultorio de Dermatología', 'location' => 'Planta Alta'],
            ['code' => 'R005', 'name' => 'Consultorio 5', 'description' => 'Consultorio de Endocrinología', 'location' => 'Planta Alta'],
            ['code' => 'R006', 'name' => 'Consultorio 6', 'description' => 'Consultorio de Ginecología', 'location' => 'Planta Alta'],
            ['code' => 'R007', 'name' => 'Consultorio 7', 'description' => 'Consultorio de Urología', 'location' => 'Planta Alta'],
            ['code' => 'R008', 'name' => 'Consultorio 8', 'description' => 'Consultorio de Oftalmología', 'location' => 'Planta Alta'],
            ['code' => 'R009', 'name' => 'Consultorio 9', 'description' => 'Consultorio de Otorrinolaringología', 'location' => 'Planta Baja'],
            ['code' => 'R010', 'name' => 'Consultorio 10', 'description' => 'Consultorio de Reumatología', 'location' => 'Planta Baja'],
            ['code' => 'R011', 'name' => 'Consultorio 11', 'description' => 'Consultorio de Psiquiatría', 'location' => 'Planta Baja'],
            ['code' => 'R012', 'name' => 'Consultorio 12', 'description' => 'Consultorio de Psicología', 'location' => 'Planta Baja'],
            ['code' => 'R013', 'name' => 'Consultorio 13', 'description' => 'Consultorio de Nutrición', 'location' => 'Planta Alta'],
            ['code' => 'R014', 'name' => 'Consultorio 14', 'description' => 'Consultorio de Fisioterapia', 'location' => 'Planta Alta'],
            ['code' => 'R015', 'name' => 'Consultorio 15', 'description' => 'Consultorio de Medicina General', 'location' => 'Planta Alta'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
