<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'schedule', 'day_id');
    }
}
