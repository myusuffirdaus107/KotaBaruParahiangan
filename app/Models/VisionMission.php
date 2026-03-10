<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    protected $fillable = [
        'vision_title',
        'vision_description',
        'mission_title',
        'mission_description',
        'image',
    ];
}
