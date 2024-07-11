<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticDetail extends Model
{
    use HasFactory;

    protected $fillable = ['id_diagnostic', 'code', 'description'];

}
