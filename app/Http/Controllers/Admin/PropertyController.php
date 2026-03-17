<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of properties.
     */
    public function index(Request $request)
    {
        $query      = Property::with('category');
        $categories = Category::all();

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Search by title or location
        if ($request->filled('search')) {
            $search = '%' . strip_tags($request->search) . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                  ->orWhere('location', 'like', $search);
            });
        }

        $properties = $query->latest()->paginate(15)->appends($request->query());

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
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|unique:properties|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric',
            'location'    => 'required|string|max:255',
            'status'      => 'required|in:available,sold_out',
            'featured'    => 'boolean',
            'brochure'    => 'nullable|file|mimes:pdf|max:10240',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Auto-generate slug jika kosong
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }

        // Checkbox featured: false jika tidak dicentang
        $validated['featured'] = $request->boolean('featured');

        // Handle upload brochure
        if ($request->hasFile('brochure')) {
            $validated['brochure'] = $request->file('brochure')->store('brochures', 'public');
        } else {
            unset($validated['brochure']);
        }

        $property = Property::create($validated);

        // Handle upload gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path'  => $path,
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
        $images     = $property->images;
        return view('admin.properties.form', compact('property', 'categories', 'images'));
    }

    /**
     * Update the specified property in storage.
     */
    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'slug'            => 'nullable|string|max:255|unique:properties,slug,' . $property->id,
            'category_id'     => 'required|exists:categories,id',
            'description'     => 'nullable|string',
            'price'           => 'nullable|numeric',
            'location'        => 'required|string|max:255',
            'status'          => 'required|in:available,sold_out',
            'featured'        => 'boolean',
            'brochure'        => 'nullable|file|mimes:pdf|max:10240',
            'images'          => 'nullable|array',
            'images.*'        => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'delete_images'   => 'nullable|array',
            'delete_images.*' => 'integer|exists:property_images,id',
            'delete_brochure' => 'nullable|boolean',
        ]);

        // Auto-generate slug jika kosong
        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }

        // Checkbox featured: false jika tidak dicentang
        $validated['featured'] = $request->boolean('featured');

        // Handle hapus brochure
        if ($request->boolean('delete_brochure')) {
            if ($property->brochure) {
                Storage::disk('public')->delete($property->brochure);
            }
            $validated['brochure'] = null;
        }
        // Handle upload brochure baru
        elseif ($request->hasFile('brochure')) {
            if ($property->brochure) {
                Storage::disk('public')->delete($property->brochure);
            }
            $validated['brochure'] = $request->file('brochure')->store('brochures', 'public');
        }
        // Tidak ada perubahan brochure — jangan overwrite nilai lama
        else {
            unset($validated['brochure']);
        }

        $property->update($validated);

        // Hapus gambar yang dipilih + file fisiknya
        if ($request->has('delete_images')) {
            $imagesToDelete = PropertyImage::whereIn('id', $request->delete_images)->get();
            foreach ($imagesToDelete as $img) {
                Storage::disk('public')->delete($img->image_path);
            }
            PropertyImage::whereIn('id', $request->delete_images)->delete();
        }

        // Upload gambar baru
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path'  => $path,
                ]);
            }
        }

        return redirect()->route('admin.properties.index')
                         ->with('success', 'Properti berhasil diupdate');
    }

    /**
     * Delete a property beserta semua file terkait.
     */
    public function destroy(Property $property)
    {
        // Hapus file brochure
        if ($property->brochure) {
            Storage::disk('public')->delete($property->brochure);
        }

        // Hapus semua file gambar
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $property->delete();

        return redirect()->route('admin.properties.index')
                         ->with('success', 'Properti berhasil dihapus');
    }
}