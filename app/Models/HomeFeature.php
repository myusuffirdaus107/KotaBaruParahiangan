<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeFeature extends Model
{
    protected $fillable = [
        'home_section_id',
        'feature_text',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function homeSection(): BelongsTo
    {
        return $this->belongsTo(HomeSection::class);
    }
}
