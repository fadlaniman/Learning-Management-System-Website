<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;

    public function userAttend()
    {
        return $this->hasMany(UserAttendance::class, 'attendance_id', 'id');
    }
}
