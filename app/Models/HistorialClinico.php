<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialClinico extends Model
{
    use HasFactory;

    protected $table = 'historial_clinico';
    protected $primaryKey = 'idhistorial_clinico';

    protected $fillable = [
        'recomendaciones', 'usuario_registro'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'historial_clinico_idhistorial_clinico');
    }

    public function diagnosticos()
    {
        return $this->belongsToMany(Diagnostico::class, 'diagnostico_has_historial_clinico', 'historial_clinico_idhistorial_clinico', 'diagnostico_iddiagnostico');
    }
}

