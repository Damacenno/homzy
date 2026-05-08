<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleaningJob extends Model
{
    protected $casts = [
        'tasks' => 'array',
        'scheduled_at' => 'datetime',
    ];
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(JobStatus::class, 'status_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}
