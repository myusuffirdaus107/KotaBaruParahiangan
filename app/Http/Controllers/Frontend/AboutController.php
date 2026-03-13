<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $pageTitle = 'Tentang Kami - Properti Kotabaru';

        // Get about content from database
        $about = About::first();

        // Get active facilities sorted by order with their items
        $facilities = Facility::where('is_active', true)
            ->orderBy('order')
            ->with('facilityItems')
            ->get();

        return view('frontend.pengunjung.about', compact('pageTitle', 'about', 'facilities'));
    }
}
