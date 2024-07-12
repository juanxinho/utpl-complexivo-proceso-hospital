<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointment';
    protected $primaryKey = 'id_appointment';

    protected $fillable = [
        'id_patient',
        'user_register',
        'user_modification',
        'record_date',
        'modification_date',
        'status',
        'medic_schedule_id_medic_schedule',
        'invoice_id_invoice',
        'clinical_history_id_clinical_history',
        'service_date',
        'reason',
        'next_control_date',
        'rating',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_patient');
    }

    public function medicSchedule()
    {
        return $this->belongsTo(MedicSchedule::class, 'medic_schedule_id_medic_schedule');
    }

    public function clinicalHistory()
    {
        return $this->belongsTo(ClinicalHistory::class, 'clinical_history_id_clinical_history');
    }

    public function diagnostics()
    {
        return $this->hasMany(Diagnostics::class, 'id_appointment');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'appointment_id', 'id_appointment');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id_invoice');
    }

    public function medicalDiagnostics()
    {
        return $this->hasMany(MedicalDiagnostic::class, 'appointment_id', 'id_appointment');
    }

}

