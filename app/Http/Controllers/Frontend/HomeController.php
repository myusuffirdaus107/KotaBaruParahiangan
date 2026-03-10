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
        $launchings = Launching::active()->latest()->limit(3)->get();
        $featuredProperties = Property::available()->featured()->latest()->limit(6)->get();

        return view('frontend.home', compact('sliders', 'launchings', 'featuredProperties'));
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
        return view('frontend.kontak');
    }

    public function brochure()
    {
        $properties = Property::with(['category', 'propertyImages'])->whereNotNull('brochure')->get();
        $categories = Category::all();
        return view('frontend.brochure', compact('properties', 'categories'));
    }
}
