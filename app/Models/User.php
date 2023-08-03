<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'status',
        'user_profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    
    protected $attributes = [
        'profile_picture' => 'storage/profile-pictures/user.png',
        'status' => 'offline',
    ];

    // public function getProfilePictureUrlAttribute()
    // {
    //     $env = env('APP_ENV');
    //     if ($env === 'production') {
    //         return 'https://somthing.com/' . $this->profile_picture;
    //     } else {
    //         return asset($this->profile_picture);
    //     }
    // }

    /**
     * User Model Relations
     */

     public function rooms()
     {
         return $this->hasMany(Room::class);
     }

     public function friends()
     {
         return $this->hasMany(Friend::class);
     }
 
 
}
