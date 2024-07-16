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
        'day_id',
        'time_range',
    ];

    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    public function medics()
    {
        return $this->belongsToMany(User::class, 'medic_schedule', 'id_schedule', 'id_medic');
    }

    public function medicSchedules()
    {
        return $this->hasMany(MedicSchedule::class, 'id_schedule', 'id_schedule');
    }
}
