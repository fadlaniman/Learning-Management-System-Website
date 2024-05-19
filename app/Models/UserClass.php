<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserClass extends Pivot
{
    protected $table = 'user_class';
}
