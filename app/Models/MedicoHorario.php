<?php

// MedicoHorario.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoHorario extends Model
{
    use HasFactory;

    protected $table = 'medico_horario';
    protected $primaryKey = 'idmedico_horario';

    protected $fillable = [
        'usuario_rol_idusuario_rol', 'especialidad_idespecialidad', 'horario_idhorario'
    ];

    public function usuarioRol()
    {
        return $this->belongsTo(UsuarioRol::class, 'usuario_rol_idusuario_rol');
    }

    public function especialidad()
    {
        return $this->belongsTo(Specialty::class, 'especialidad_idespecialidad');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_idhorario');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'medico_horario_idmedico_horario');
    }
}
