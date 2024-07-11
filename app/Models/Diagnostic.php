<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = ['id_clinical_history', 'description', 'user_register', 'date'];

    protected $table = 'diagnostic';
    protected $primaryKey = 'id_diagnostic';

    public function clinicalHistory()
    {
        return $this->belongsTo(ClinicalHistory::class, 'id_clinical_history', 'id_clinical_history');
    }

    public function details()
    {
        return $this->hasMany(DiagnosticDetail::class, 'id_diagnostic');
    }
}
