<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'school',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function teachingClasses(): HasMany
    {
        return $this->hasMany(
            LearningClass::class,
            'teacher_id'
        );
    }

    public function joinedClasses(): BelongsToMany
    {
        return $this->belongsToMany(
            LearningClass::class,
            'learning_class_user',
            'user_id',
            'learning_class_id'
        )->withTimestamps();
    }

    public function isStudent(): bool
    {
        return $this->role === 'murid';
    }

    public function isTeacher(): bool
    {
        return $this->role === 'guru';
    }
}