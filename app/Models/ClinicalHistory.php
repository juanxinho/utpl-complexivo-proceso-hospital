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

    public function diagnostics()
    {
        return $this->belongsToMany(Diagnostic::class, 'diagnostic_has_clinical_history', 'clinical_history_id_clinical_history', 'diagnostic_id_diagnostic');
    }
}

