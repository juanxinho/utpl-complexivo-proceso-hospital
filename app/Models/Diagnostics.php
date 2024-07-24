<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostics extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'diagnostics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'description'];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The medical diagnostics that belong to the diagnostic.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medicalDiagnostics()
    {
        return $this->belongsToMany(MedicalDiagnostic::class, 'diagnostic_medical_diagnostic', 'diagnostic_id', 'medical_diagnostic_id');
    }
}
