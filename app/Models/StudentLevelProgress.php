<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentLevelProgress extends Model
{
    protected $table = 'student_level_progresses';

    protected $fillable = [
        'user_id',
        'class_code',
        'jenjang',
        'level_id',
        'score',
        'stars',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}