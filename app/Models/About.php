<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'section_title',
        'description',
        'image_path',
        'vision_title',
        'vision_content',
        'mission_content',
    ];
}
