<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idusuario';

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'idpersona', 'idpersona');
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'usuario_rol', 'idusuario', 'idrol');
    }
}
