<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_id',
        'name',
        'email',
        'phone',
        'message',
        'is_contacted',
    ];

    protected $casts = [
        'is_contacted' => 'boolean',
    ];

    /**
     * Get the property that has the inquiry.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Scope to get uncontacted inquiries.
     */
    public function scopeUncontacted($query)
    {
        return $query->where('is_contacted', false);
    }
}
