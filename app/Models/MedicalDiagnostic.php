<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalDiagnostic extends Model
{
    use HasFactory;

    protected $fillable = ['id_clinical_history', 'appointment_id', 'recommendations', 'user_register', 'date'];

    protected $table = 'medical_diagnostic';
    protected $primaryKey = 'id';

    public function clinicalHistory()
    {
        return $this->belongsTo(ClinicalHistory::class, 'id_clinical_history', 'id_clinical_history');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'id_appointment', 'appointment_id');
    }

    public function diagnostics()
    {
        return $this->belongsToMany(Diagnostics::class, 'diagnostic_medical_diagnostic', 'medical_diagnostic_id', 'diagnostic_id');
    }

    public function medicalTests()
    {
        return $this->belongsToMany(MedicalTest::class, 'diagnostic_medical_test', 'medical_diagnostic_id', 'medical_test_id');
    }
}
