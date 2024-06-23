<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Attachments extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'attachment_id', 'id');
    }
}
