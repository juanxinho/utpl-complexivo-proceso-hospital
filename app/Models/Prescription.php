<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'patient_id', 'appointment_id', 'doctor_id',  'notes'];
    protected $table = 'prescriptions';
    protected $primaryKey = 'id';

    public function items()
    {
        return $this->hasMany(PrescriptionItem::class, 'prescription_id', 'id');
    }
}

