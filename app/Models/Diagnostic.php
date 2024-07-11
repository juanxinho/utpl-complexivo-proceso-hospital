<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'date',
    ];
    
    protected $table = 'diagnostic';
    protected $primaryKey = 'id_diagnostic';

    public function clinicalHistory()
    {
        return $this->belongsTo(ClinicalHistory::class, 'id_clinical_history', 'id_clinical_history');
    }
}
