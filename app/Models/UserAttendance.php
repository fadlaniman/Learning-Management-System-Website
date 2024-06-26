<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttendance extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public function attendances()
    {
        return $this->belongsTo(Attendances::class, 'attendance_id', 'id');
    }
}
