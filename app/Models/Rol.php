<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'idrol';

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuario_rol', 'idrol', 'idusuario');
    }
}
