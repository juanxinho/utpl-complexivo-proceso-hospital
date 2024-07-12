<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalTest extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'category'];
    protected $primaryKey = 'id';

    public function medicalDiagnostics()
    {
        return $this->belongsToMany(MedicalDiagnostic::class, 'diagnostic_medical_test', 'medical_test_id', 'medical_diagnostic_id');
    }
}
