<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'patient_id', 'appointment_id', 'doctor_id', 'notes'];

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'prescriptions';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Get the prescription items for the prescription.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(PrescriptionItem::class, 'prescription_id', 'id');
    }

    /**
     * Get the appointment associated with the prescription.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function appointment()
    {
        return $this->hasOne(Appointment::class, 'id_appointment', 'appointment_id');
    }
}
