<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'idpersona';

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'idpersona', 'idpersona');
    }
}
