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
        'user_rol_id_user_rol', 'specialty_id_specialty', 'schedule_id_schedule'
    ];

    public function usuarioRol()
    {
        return $this->belongsTo(UsuarioRol::class, 'user_rol_id_user_rol');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id_specialty');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id_schedule');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'medic_schedule_id_medic_schedule');
    }
}
