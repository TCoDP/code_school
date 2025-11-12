<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'age_range',
        'description',
        'technologies',
        'total_lessons',
        'is_active',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_active' => 'boolean',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['progress', 'lessons_completed', 'homeworks_completed', 'status', 'started_at', 'completed_at'])
            ->withTimestamps();
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }
}
