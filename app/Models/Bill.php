<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'factura';
    protected $primaryKey = 'idfactura';

    protected $fillable = [
        'estado', 'detalle', 'total'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'factura_idfactura');
    }
}

