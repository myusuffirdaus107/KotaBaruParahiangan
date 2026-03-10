<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Category;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of properties.
     */
    public function index(Request $request)
    {
        $query = Property::with('category');
        $categories = Category::all();

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search by title or location
        if ($request->filled('search')) {
            $search = '%' . strip_tags($request->search) . '%';
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', $search)
                  ->orWhere('location', 'like', $search);
            });
        }

        $properties = $query->paginate(15)->appends($request->query());

        return view('admin.properties.index', compact('properties', 'categories'));
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.properties.form', compact('categories'));
    }

    /**
     * Store a newly created property in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:properties|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price_from' => 'nullable|numeric',
            'price_to' => 'nullable|numeric',
            'location' => 'required|string|max:255',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'brochure' => 'nullable|file|mimes:pdf|max:10240',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Create property
        $property = Property::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.properties.index')
                       ->with('success', 'Properti berhasil ditambahkan');
    }

    /**
     * Show the form for editing a property.
     */
    public function edit(Property $property)
    {
        $categories = Category::all();
        $images = $property->images;
        return view('admin.properties.form', compact('property', 'categories', 'images'));
    }

    /**
     * Update the specified property in storage.
     */
    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:properties,slug,'.$property->id,
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price_from' => 'nullable|numeric',
            'price_to' => 'nullable|numeric',
            'location' => 'required|string|max:255',
            'is_featured' => 'boolean',
            'is_available' => 'boolean',
            'brochure' => 'nullable|file|mimes:pdf|max:10240',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer|exists:property_images,id',
        ]);

        $property->update($validated);

        // Delete selected images
        if ($request->has('delete_images')) {
            PropertyImage::whereIn('id', $request->delete_images)->delete();
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.properties.index')
                       ->with('success', 'Properti berhasil diupdate');
    }

    /**
     * Delete a property.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')
                       ->with('success', 'Properti berhasil dihapus');
    }
}
