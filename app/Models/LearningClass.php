<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LearningClass extends Model
{
    protected $fillable = [
        'teacher_id',
        'name',
        'level',
        'join_code',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'learning_class_user',
            'learning_class_id',
            'user_id'
        )->withTimestamps();
    }
}
