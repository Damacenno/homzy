<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    public function Owner()
    {
        return $this->belongsTo(User::class);
    }

}
