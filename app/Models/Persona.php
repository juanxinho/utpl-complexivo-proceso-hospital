<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'idpersona';

    protected $fillable = [
        'cedula', 'nombres', 'apellidos', 'fecha_nacimiento', 'telefono', 'sexo', 'estado', 'usuario_registro', 'usuario_modificacion'
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'idpersona', 'idpersona');
    }
}
