<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'uid';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'email', 'password', 'role'
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
    ];

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'user_class', 'user_id', 'class_id')->withTimestamps();
    }

    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'user_id', 'uid');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'attachment_id', 'uid');
    }
}
