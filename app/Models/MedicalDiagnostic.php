<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalDiagnostic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_clinical_history',
        'appointment_id',
        'recommendations',
        'user_register',
        'date'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_diagnostic';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Get the clinical history associated with the medical diagnostic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clinicalHistory()
    {
        return $this->belongsTo(ClinicalHistory::class, 'id_clinical_history', 'id_clinical_history');
    }

    /**
     * Get the appointment associated with the medical diagnostic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'id_appointment', 'appointment_id');
    }

    /**
     * The diagnostics that belong to the medical diagnostic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function diagnostics()
    {
        return $this->belongsToMany(Diagnostics::class, 'diagnostic_medical_diagnostic', 'medical_diagnostic_id', 'diagnostic_id');
    }

    /**
     * The medical tests that belong to the medical diagnostic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medicalTests()
    {
        return $this->belongsToMany(MedicalTest::class, 'diagnostic_medical_test', 'medical_diagnostic_id', 'medical_test_id');
    }
}
