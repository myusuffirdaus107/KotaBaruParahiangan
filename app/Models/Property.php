<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'price',
        'location',
        'status',
        'brochure',
        'featured',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'price'    => 'integer',
    ];

    /**
     * Get the category that owns the property.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all images for the property.
     */
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    /**
     * Get all inquiries for the property.
     */
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    /**
     * Scope: properti yang statusnya available.
     * Menggunakan kolom 'status' sesuai migration.
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope: properti yang ditandai featured.
     * Menggunakan kolom 'featured' sesuai migration.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}