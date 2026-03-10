<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeImage extends Model
{
    protected $fillable = [
        'home_section_id',
        'image_path',
        'alt_text',
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
