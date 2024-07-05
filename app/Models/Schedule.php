<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule'; // especifica el nombre de la tabla

    protected $primaryKey = 'id_schedule';

    protected $fillable = [
        'days',
        'time_range',
    ];

    public function medics()
    {
        return $this->belongsToMany(User::class, 'medic_schedule', 'id_schedule', 'id_medic');
    }
}
