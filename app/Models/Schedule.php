<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schedule';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_schedule';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'day_id',
        'time_range',
    ];

    /**
     * Get the day associated with the schedule.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    /**
     * The medics that belong to the schedule.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medics()
    {
        return $this->belongsToMany(User::class, 'medic_schedule', 'id_schedule', 'id_medic');
    }

    /**
     * Get the medic schedules for the schedule.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicSchedules()
    {
        return $this->hasMany(MedicSchedule::class, 'id_schedule', 'id_schedule');
    }
}
