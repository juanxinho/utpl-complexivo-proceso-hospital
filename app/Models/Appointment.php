<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appointment';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_appointment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * Get the patient associated with the appointment.
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_patient');
    }

    /**
     * Get the medic schedule associated with the appointment.
     */
    public function medicSchedule()
    {
        return $this->belongsTo(MedicSchedule::class, 'medic_schedule_id_medic_schedule');
    }

    /**
     * Get the clinical history associated with the appointment.
     */
    public function clinicalHistory()
    {
        return $this->belongsTo(ClinicalHistory::class, 'clinical_history_id_clinical_history');
    }

    /**
     * Get the diagnostics for the appointment.
     */
    public function diagnostics()
    {
        return $this->hasMany(Diagnostics::class, 'id_appointment');
    }

    /**
     * Get the prescriptions for the appointment.
     */
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'appointment_id', 'id_appointment');
    }

    /**
     * Get the invoice associated with the appointment.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id_invoice');
    }

    /**
     * Get the medical diagnostics associated with the appointment.
     */
    public function medicalDiagnostics()
    {
        return $this->hasMany(MedicalDiagnostic::class, 'appointment_id', 'id_appointment');
    }
}
