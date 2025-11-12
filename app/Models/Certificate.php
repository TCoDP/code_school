<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'level',
        'progress',
        'completed_tasks',
        'total_tasks',
        'status',
        'issued_at',
        'file_path',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
