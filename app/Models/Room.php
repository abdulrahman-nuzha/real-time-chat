<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id_1',
        'user_id_2',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Room Model Relations
     */

    // public function userOdd()
    // {
    //     return $this->belongsTo(User::class, 'user_id_1');
    // }

    // public function userEven()
    // {
    //     return $this->belongsTo(User::class, 'user_id_2');
    // }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class)
    //         ->where(function ($query) {
    //             $query->where('user_id_1', $this->user_id_1)
    //                   ->orWhere('user_id_2', $this->user_id_2);
    //         });
    // }

    public function users()
    {
        return $this->belongsToMany(User::class, 'rooms', 'user_id_1', 'user_id_2');
    }
}

