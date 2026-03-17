<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Launching;
use App\Models\Property;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::active()->get();

    $launchings = Launching::whereIn('status', ['active', 'coming_soon'])
        ->orderByDesc('launch_date')
        ->get();

    $featuredProperties = Property::available()
        ->featured()
        ->with(['images', 'category'])
        ->whereHas('category', function ($q) {
            $q->where('slug', 'hunian');
        })
        ->latest()
        ->limit(3)
        ->get();

    return view('frontend.pengunjung.home', compact(
        'sliders', 'launchings', 'featuredProperties'
    ));
    }

    public function kawasan()
    {
        return view('frontend.kawasan');
    }

    public function launching()
    {
        $launchings = Launching::latest()->paginate(9);
        return view('frontend.launching', compact('launchings'));
    }

    public function kontak()
    {
        return view('frontend.pengunjung.kontak');
    }

    public function brochure()
    {
        $properties = Property::with(['category', 'images'])->whereNotNull('brochure')->get();
        $categories = Category::all();
        return view('frontend.brochure', compact('properties', 'categories'));
    }
}
