<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LearningMaterial extends Model
{
    protected $fillable = [
        'teacher_id',
        'learning_class_id',
        'title',
        'type',
        'level',
        'status',
        'content',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'teacher_id'
        );
    }

    public function learningClass(): BelongsTo
    {
        return $this->belongsTo(
            LearningClass::class,
            'learning_class_id'
        );
    }
}