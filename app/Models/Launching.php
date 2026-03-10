<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Launching extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'location',
        'developer',
        'launch_date',
        'status',
    ];

    /**
     * Get active launchings for frontend display.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get coming soon launchings.
     */
    public function scopeComingSoon($query)
    {
        return $query->where('status', 'coming_soon');
    }
}
