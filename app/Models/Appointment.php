<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'idcita';

    protected $fillable = [
        'usuario_registro',
        'usuario_modificacion',
        'fecha_registro',
        'fecha_modificacion',
        'estado',
        'medico_horario_idmedico_horario',
        'usuario_rol_idusuario_rol',
        'factura_idfactura',
        'historial_clinico_idhistorial_clinico',
        'fecha_atencion'
    ];

    public function medicoHorario()
    {
        return $this->belongsTo(MedicoHorario::class, 'medico_horario_idmedico_horario');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'factura_idfactura');
    }

    public function historialClinico()
    {
        return $this->belongsTo(HistorialClinico::class, 'historial_clinico_idhistorial_clinico');
    }
}

