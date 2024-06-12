<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


class UserClass extends Pivot
{
    protected $table = 'user_class';

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
}
