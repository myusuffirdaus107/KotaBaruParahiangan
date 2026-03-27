<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SliderController extends Controller
{
    /**
     * Display sliders.
     */
    public function index()
    {
        $sliders = Slider::paginate(15);
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.sliders.form');
    }

    /**
     * Store slider.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'order'     => 'integer|min:1',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sliders', 'public');
            $validated['image'] = $imagePath;
        }

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')
                       ->with('success', 'Slider berhasil ditambahkan');
    }

    /**
     * Show edit form.
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.form', compact('slider'));
    }

    /**
     * Update slider.
     */
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'order' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
        // Hapus gambar lama sebelum upload baru
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        $validated['image'] = $request->file('image')->store('sliders', 'public');
    }

    $slider->update($validated);

    return redirect()->route('admin.sliders.index')
                   ->with('success', 'Slider berhasil diupdate');
    }

    /**
     * Delete slider.
     */
    public function destroy(Slider $slider)
    {
        if ($slider->image) {
        Storage::disk('public')->delete($slider->image);
    }
        $slider->delete();
        return redirect()->route('admin.sliders.index')
                       ->with('success', 'Slider berhasil dihapus');
    }
}
