<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'factura';
    protected $primaryKey = 'idfactura';

    protected $fillable = [
        'estado', 'detalle', 'total'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'factura_idfactura');
    }
}

