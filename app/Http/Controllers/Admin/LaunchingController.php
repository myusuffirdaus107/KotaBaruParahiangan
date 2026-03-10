<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Launching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaunchingController extends Controller
{
    /**
     * Display launchings.
     */
    public function index(Request $request)
    {
        $query = Launching::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', '%'.$search.'%')
                  ->orWhere('location', 'like', '%'.$search.'%')
                  ->orWhere('developer', 'like', '%'.$search.'%');
        }

        $launchings = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.launchings.index', compact('launchings'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.launchings.form');
    }

    /**
     * Store launching.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:launchings,slug|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'location' => 'nullable|string|max:255',
            'developer' => 'nullable|string|max:255',
            'launch_date' => 'nullable|date',
            'status' => 'required|in:coming_soon,active',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('launchings', 'public');
            $validated['image'] = $imagePath;
        }

        Launching::create($validated);

        return redirect()->route('admin.launchings.index')
                       ->with('success', 'Launching berhasil ditambahkan');
    }

    /**
     * Show edit form.
     */
    public function edit(Launching $launching)
    {
        return view('admin.launchings.form', compact('launching'));
    }

    /**
     * Update launching.
     */
    public function update(Request $request, Launching $launching)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:launchings,slug,'.$launching->id,
            'description' => 'nullable|string',
            'image' => $request->hasFile('image') ? 'image|mimes:jpeg,png,jpg,gif|max:10240' : 'nullable',
            'location' => 'nullable|string|max:255',
            'developer' => 'nullable|string|max:255',
            'launch_date' => 'nullable|date',
            'status' => 'required|in:coming_soon,active',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($launching->image && Storage::disk('public')->exists($launching->image)) {
                Storage::disk('public')->delete($launching->image);
            }
            $imagePath = $request->file('image')->store('launchings', 'public');
            $validated['image'] = $imagePath;
        }

        $launching->update($validated);

        return redirect()->route('admin.launchings.index')
                       ->with('success', 'Launching berhasil diperbarui');
    }

    /**
     * Delete launching.
     */
    public function destroy(Launching $launching)
    {
        if ($launching->image && Storage::disk('public')->exists($launching->image)) {
            Storage::disk('public')->delete($launching->image);
        }
        $launching->delete();
        return redirect()->route('admin.launchings.index')
                       ->with('success', 'Launching berhasil dihapus');
    }
}
