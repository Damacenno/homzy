<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'skills' => 'array',
            'can_be_found' => 'boolean',
        ];
    }


    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function getTopSkillsAttribute()
    {
        $skills = $this->skills;
        if (is_string($skills)) {
            $skills = json_decode($skills, true);
        }

        if (!is_array($skills)) {
            return [];
        }

        return collect($skills)
            ->sortByDesc(fn($skill) => (int) ($skill['Level'] ?? 0))
            ->take(3)
            ->values()
            ->all();
    }
}
