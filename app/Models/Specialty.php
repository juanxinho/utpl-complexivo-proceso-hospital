<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $table = 'specialty';
    protected $primaryKey = 'id_specialty';

    protected $fillable = [
        'name', 'abbreviation', 'description', 'status'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'medico_schedule', 'id_specialty', 'id_patient');
    }
}

