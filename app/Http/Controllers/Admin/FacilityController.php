<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use App\Models\FacilityItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::with('facilityItems')->orderBy('order')->get();
        return view('admin.facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.facilities.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'description' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('facilities', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Facility::create($validated);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        return view('admin.facilities.form', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'description' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($facility->banner && \Storage::disk('public')->exists($facility->banner)) {
                \Storage::disk('public')->delete($facility->banner);
            }
            $validated['banner'] = $request->file('banner')->store('facilities', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $facility->update($validated);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        if ($facility->banner && \Storage::disk('public')->exists($facility->banner)) {
            \Storage::disk('public')->delete($facility->banner);
        }

        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus');
    }

    /**
     * Manage facility items
     */
    public function editItems(Facility $facility)
    {
        return view('admin.facilities.items', compact('facility'));
    }

    /**
     * Store facility item
     */
    public function storeItem(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('facility-items', 'public');
        }

        $facility->facilityItems()->create($validated);

        return redirect()->route('admin.facilities.items', $facility)->with('success', 'Item berhasil ditambahkan');
    }

    /**
     * Update facility item
     */
    public function updateItem(Request $request, Facility $facility, FacilityItem $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image && \Storage::disk('public')->exists($item->image)) {
                \Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('facility-items', 'public');
        }

        $item->update($validated);

        return redirect()->route('admin.facilities.items', $facility)->with('success', 'Item berhasil diperbarui');
    }

    /**
     * Delete facility item
     */
    public function destroyItem(Facility $facility, FacilityItem $item)
    {
        if ($item->image && \Storage::disk('public')->exists($item->image)) {
            \Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('admin.facilities.items', $facility)->with('success', 'Item berhasil dihapus');
    }
}
