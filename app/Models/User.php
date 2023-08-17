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

    public function areFriends(User $otherUser)
    {
        $friendship = Friend::where(function ($query) use ($otherUser) {
            $query->where('user_id_1', $this->id)
                ->where('user_id_2', $otherUser->id);
        })
            ->orWhere(function ($query) use ($otherUser) {
                $query->where('user_id_1', $otherUser->id)
                    ->where('user_id_2', $this->id);
            })
            ->first();

        return $friendship ? $friendship->status : null;
    }


    /**
     * User Model Relations
     */

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function friends()
    {
        $userId = $this->id;

        return User::query()
            ->join('friends', function ($join) use ($userId) {
                $join->on('users.id', '=', 'friends.user_id_1')
                    ->where('friends.user_id_2', '=', $userId)
                    ->orWhere(function ($query) use ($userId) {
                        $query->on('users.id', '=', 'friends.user_id_2')
                            ->where('friends.user_id_1', '=', $userId);
                    });
            })
            ->select('users.*')
            ->paginate();
    }
    public function approvedFriends()
    {
        // return $this->belongsToMany(User::class, 'friends', 'user_id_1', 'user_id_2')
        //     ->where('friends.status', 'approved');
        $userId = $this->id;

        return User::query()
            ->join('friends', function ($join) use ($userId) {
                $join->on('users.id', '=', 'friends.user_id_1')
                    ->where('friends.user_id_2', '=', $userId)
                    ->orWhere(function ($query) use ($userId) {
                        $query->on('users.id', '=', 'friends.user_id_2')
                            ->where('friends.user_id_1', '=', $userId);
                    });
            })
            ->where('friends.status', '=', 'approved')
            ->select('users.*')
            ->paginate();
    }

    public function friendsRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id_2', 'user_id_1')
            ->where('friends.status', 'pending');
    }
}
