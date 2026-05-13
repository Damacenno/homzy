<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'application_type',
        'applicant_id',
        'job_id',
        'cleaner_id',
        'status',
        'message'
    ];

    public function job()
    {
        return $this->belongsTo(CleaningJob::class, 'job_id');
    }

    public function cleaner()
    {
        return $this->belongsTo(User::class, 'cleaner_id');
    }
}
