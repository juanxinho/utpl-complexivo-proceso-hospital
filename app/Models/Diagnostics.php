<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostics extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'description'];
    protected $primaryKey = 'id';

    public function medicalDiagnostics()
    {
        return $this->belongsToMany(MedicalDiagnostic::class, 'diagnostic_medical_diagnostic', 'diagnostic_id', 'medical_diagnostic_id');
    }
}
