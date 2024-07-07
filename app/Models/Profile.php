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
        'nid', 'first_name', 'last_name', 'dob', 'phone', 'gender', 'user_register', 'user_modification'
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
}
