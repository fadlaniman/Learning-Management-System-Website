<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table = 'class';
    protected $keyType = 'string';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_class', 'class_id', 'user_id')->withTimestamps();
    }

    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'class_id', 'id');
    }
}
