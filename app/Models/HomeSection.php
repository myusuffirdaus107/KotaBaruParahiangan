<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(HomeImage::class)->orderBy('order');
    }

    public function features(): HasMany
    {
        return $this->hasMany(HomeFeature::class)->orderBy('order');
    }
}
