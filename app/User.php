<?php

namespace App;

use App\Models\Country\Country;
use App\Models\Gender\Gender;
use App\Models\Photos\Photo;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use  HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'name', 
        'email',
        'password',
        'gender_id',
        'country_id',
        'dob',
        'city',
        'image',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'datetime',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
   
}
