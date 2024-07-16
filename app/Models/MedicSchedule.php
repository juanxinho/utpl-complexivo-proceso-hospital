<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicSchedule extends Model
{
    use HasFactory;

    protected $table = 'medic_schedule';
    protected $primaryKey = 'id_medic_schedule';

    protected $fillable = [
        'id_medic', 'id_specialty', 'id_schedule'
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'id_specialty');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id_schedule', 'id_schedule');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'medic_schedule_id_medic_schedule');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_medic');
    }
}
