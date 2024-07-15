<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email', 'password', 'status', 'user_register', 'user_modification', 'id_profile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->profile->first_name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=0ac60a&background=effbef';
    }

    public function getStatusLabelAttribute()
    {
        return $this->status ? __('Active') : __('Inactive');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'id_profile', 'id_profile');
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'specialty_user','id_user', 'id_specialty');
    }

    public function medicSchedules()
    {
        return $this->hasMany(MedicSchedule::class, 'id_medic', 'id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id_patient', 'id');
    }

    public function clinicalHistory()
    {
        return $this->hasOne(ClinicalHistory::class, 'patient_id', 'id');
    }
}
