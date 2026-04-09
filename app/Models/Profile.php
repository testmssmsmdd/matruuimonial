<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'age',
        'birth_time',
        'birth_place',
        'height',
        'Weight',
        'marital_status',
        'mother_tounge',
        'rashi',
        'caste',
        'gotra',
        'manglik',
        'country_id',
        'state_id',
        'city_id',
        'current_address',
        'education',
        'occupation',
        'company_name',
        'annual_income',
        'work_location',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'no_of_brothers',
        'no_of_sisters',
        'family_type',
        'hobbies',
        'about_me',
        'profile_status',
        'created_by',
        'profile_completed',
        'contact_person_name',
        'contact_person_number',
        'contact_person_wp_number',
        'contact_person_email',
        'show_contact_publicly',
        'mosal_name',
        'user_id'
    ];


    public function mosals()
    {
        return $this->hasMany(Mosal::class);
    }

    public function gallery_photos()
    {
        return $this->hasMany(Gallery_photos::class);
    }

    public function getHeightFtAttribute()
    {
        return floor($this->height);
    }

    public function getHeightInAttribute()
    {
        return (int)substr(strrchr($this->height, "."), 1); 
    }

    public function getBirthTimePartsAttribute()
    {
        if (!$this->birth_time) {
            return [
                'hours' => null,
                'minutes' => null,
                'format' => null,
            ];
        }

        [$time, $format] = explode(' ', $this->birth_time);
        [$hours, $minutes] = explode(':', $time);

        return [
            'hours' => (int) $hours,
            'minutes' => (int) $minutes,
            'format' => $format,
        ];
    }

    public function profile_photo()
    {
        return $this->hasOne(Gallery_photos::class)->where('is_profile_photo',1);
    }

    public function gallery_photo()
    {
        return $this->hasMany(Gallery_photos::class)->where('is_profile_photo',0);
    }

    public function city()
    {
        return $this->hasOne(City::class,'id','city_id');
    }

    public function state()
    {
        return $this->hasOne(State::class,'id','state_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function favouritedBy()
    {
        return $this->belongsToMany(
            User::class,
            'favourite_profiles',
            'profile_id',
            'user_id'
        )->withTimestamps()->withPivot('deleted_at');
    }

    public function favourites()
    {
        return $this->hasMany(FavouriteProfile::class, 'profile_id');
    }

}
