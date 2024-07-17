<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'description', 'location', 'status',
    ];

    public function medics()
    {
        return $this->belongsToMany(User::class, 'medic_room');
    }

    public function room()
    {
        return $this->belongsTo(MedicRoom::class, 'id');
    }
}
