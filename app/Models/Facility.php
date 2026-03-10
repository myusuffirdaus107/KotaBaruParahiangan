<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'description',
        'banner',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get all items for this facility
     */
    public function facilityItems(): HasMany
    {
        return $this->hasMany(FacilityItem::class);
    }

    /**
     * Scope to get only active facilities
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
