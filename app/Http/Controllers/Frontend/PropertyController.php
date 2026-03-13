<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Category;

class PropertyController extends Controller
{
    /**
     * Show all properties for a category (Hunian/Business).
     */
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $property = Property::where('category_id', $category->id)->available();

        // Filter by price
        if (request('min_price')) {
            $property->where('price', '>=', request('min_price'));
        }
        if (request('max_price')) {
            $property->where('price', '<=', request('max_price'));
        }

        // Filter by location
        if (request('location')) {
            $property->where('location', 'like', '%' . request('location') . '%');
        }

        $properties = $property->paginate(12);

        // Use different views for hunian and business
        $view = ($slug === 'hunian') ? 'frontend.pengunjung.hunian' : 'frontend.pengunjung.business';

        return view($view, compact('category', 'properties'));
    }

    /**
     * Show a single property detail.
     */
    public function show($slug)
    {
        $property = Property::where('slug', $slug)->firstOrFail();
        $relatedProperties = Property::where('category_id', $property->category_id)
            ->where('id', '!=', $property->id)
            ->available()
            ->limit(4)
            ->get();

        return view('frontend.properties.show', compact('property', 'relatedProperties'));
    }
}
