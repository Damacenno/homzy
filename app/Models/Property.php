<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    protected $fillable = [
        'name',
        'address',
        'city',
        'postal_code',
        'owner_user_id',
        'rating'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

}
