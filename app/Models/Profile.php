<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';
    protected $primaryKey = 'id_profile';

    protected $fillable = [
        'nid', 'first_name', 'last_name', 'dob', 'phone', 'gender', 'user_register', 'user_modification', 'country_id', 'state_id', 'city_id', 'address',
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->age;
    }

    public function getGenderNameAttribute($value)
    {
        return $this->gender === 'M' ? __('Male') : __('Female');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_profile', 'id_profile');
    }

    // Add relationships to Country, State, and City
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
