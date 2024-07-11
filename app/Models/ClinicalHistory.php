<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalHistory extends Model
{
    use HasFactory;

    protected $table = 'clinical_history';
    protected $primaryKey = 'id_clinical_history';

    protected $fillable = [
        'recommendations', 'user_register'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'clinical_history_id_clinical_history');
    }

    public function medical_diagnostics()
    {
        return $this->hasMany(MedicalDiagnostic::class, 'id_clinical_history', 'id_clinical_history');
    }
}

