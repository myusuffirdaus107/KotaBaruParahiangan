<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacilityItem extends Model
{
    protected $fillable = [
        'facility_id',
        'name',
        'description',
        'image',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Get the facility this item belongs to
     */
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}
