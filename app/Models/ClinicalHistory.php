<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clinical_history';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_clinical_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_register'];

    /**
     * Get the user that owns the clinical history.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Get the appointments for the clinical history.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'clinical_history_id_clinical_history');
    }

    /**
     * Get the medical diagnostics for the clinical history.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicalDiagnostics()
    {
        return $this->hasMany(MedicalDiagnostic::class, 'id', 'id_clinical_history');
    }
}
