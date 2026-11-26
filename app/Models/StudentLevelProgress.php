<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentLevelProgress extends Model
{
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
            'level_id' => 'integer',
            'score' => 'integer',
            'stars' => 'integer',
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
