<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicRoom extends Model
{
    use HasFactory;

    protected $table = 'medic_room';

    protected $fillable = [
        'user_id',
        'room_id',
        'assigned_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
