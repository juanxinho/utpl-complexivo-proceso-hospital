<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nid', 'first_name', 'last_name', 'dob', 'phone', 'gender', 'user_register', 'user_modification', 'country_id', 'state_id', 'city_id', 'address',
    ];

    /**
     * Get the user's age.
     *
     * @return int
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->age;
    }

    /**
     * Get the gender name.
     *
     * @param  string  $value
     * @return string
     */
    public function getGenderNameAttribute($value)
    {
        return $this->gender === 'M' ? __('Male') : __('Female');
    }

    /**
     * Get the user associated with the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id_profile', 'id_profile');
    }

    /**
     * Get the country associated with the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the state associated with the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the city associated with the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
