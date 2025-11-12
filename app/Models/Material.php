<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'icon',
        'type',
        'lesson_number',
        'links',
        'is_new',
    ];

    protected $casts = [
        'links' => 'array',
        'is_new' => 'boolean',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
