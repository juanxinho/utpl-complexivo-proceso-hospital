<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triage extends Model
{
    use HasFactory;

    protected $table = 'triajes';

    protected $fillable = [
        'patient_id',
        'heart_rate',
        'respiratory_rate',
        'systolic_blood_pressure',
        'diastolic_blood_pressure',
        'temperature',
        'spo2',
        'priority',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
