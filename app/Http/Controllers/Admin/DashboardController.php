<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Inquiry;
use App\Models\Slider;
use App\Models\Launching;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $totalProperties = Property::count();
        $totalInquiries = Inquiry::uncontacted()->count();
        $totalSliders = Slider::count();
        $totalLaunching = Launching::count();
        $totalCategories = Category::count();
        
        // Get recent inquiries
        $recentInquiries = Inquiry::with('property')->latest()->limit(5)->get();
        
        // Get featured properties
        $featuredProperties = Property::featured()->latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalProperties',
            'totalInquiries',
            'totalSliders',
            'totalLaunching',
            'totalCategories',
            'recentInquiries',
            'featuredProperties'
        ));
    }
}
