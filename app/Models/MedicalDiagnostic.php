<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalDiagnostic extends Model
{
    use HasFactory;

    protected $fillable = ['id_clinical_history', 'description', 'user_register', 'date'];

    protected $table = 'medical_diagnostic';
    protected $primaryKey = 'id_diagnostic';

    public function clinicalHistory()
    {
        return $this->belongsTo(ClinicalHistory::class, 'id_clinical_history', 'id_clinical_history');
    }

    public function diagnostics()
    {
        return $this->belongsToMany(Diagnostics::class, 'diagnostic_medical_diagnostic', 'medical_diagnostic_id', 'diagnostic_id');
    }
}
