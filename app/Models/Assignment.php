<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'icon',
        'lesson_number',
        'days_to_complete',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['status', 'submitted_at', 'submission', 'feedback', 'grade', 'reviewed_by', 'reviewed_at'])
            ->withTimestamps();
    }
}
