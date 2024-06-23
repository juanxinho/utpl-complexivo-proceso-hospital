<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'idrol';

    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuario_rol', 'idrol', 'id');
    }
}
