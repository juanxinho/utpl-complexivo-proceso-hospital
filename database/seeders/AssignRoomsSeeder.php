<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Room;
use App\Models\MedicRoom;

class AssignRoomsSeeder extends Seeder
{
    public function run()
    {
        $medics = User::role('medic')->where('status', 1)->get();
        $rooms = Room::all();

        $medicCount = $medics->count();
        $roomCount = $rooms->count();

        // Ensure we don't assign more rooms than there are medics
        $assignCount = min($medicCount, $roomCount);

        for ($i = 0; $i < $assignCount; $i++) {
            $medic = $medics[$i];
            $room = $rooms[$i];

            MedicRoom::create([
                'user_id' => $medic->id,
                'room_id' => $room->id,
                'assigned_date' => \Carbon\Carbon::now(),
            ]);

            // Set room status to 0 (not available)
            $room->status = 0;
            $room->save();
        }
    }
}
