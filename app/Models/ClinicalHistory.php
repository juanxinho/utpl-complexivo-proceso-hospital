<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalHistory extends Model
{
    use HasFactory;

    protected $table = 'clinical_history';
    protected $primaryKey = 'id_clinical_history';

    protected $fillable = ['user_register'];

    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'clinical_history_id_clinical_history');
    }

    public function medicalDiagnostics()
    {
        return $this->hasMany(MedicalDiagnostic::class, 'id', 'id_clinical_history');
    }
}

