<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Tambahkan ini

class JobVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'type',
        'deadline',
        'status',
    ];

    /**
     * Get the applications for the job vacancy.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
}
