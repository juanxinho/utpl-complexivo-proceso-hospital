<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';
    protected $primaryKey = 'id_invoice';

    protected $fillable = [
        'status', 'detail', 'total'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'invoice_id_invoice');
    }
}

