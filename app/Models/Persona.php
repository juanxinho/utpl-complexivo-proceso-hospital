<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';
    protected $primaryKey = 'idpersona';

    protected $fillable = [
        'cedula', 'nombres', 'apellidos', 'fecha_nacimiento', 'telefono', 'sexo', 'estado', 'usuario_registro', 'usuario_modificacion'
    ];

    public function getEdadAttribute()
    {
        return Carbon::parse($this->fecha_nacimiento)->age;
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'idpersona', 'idpersona');
    }
}
