<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\VisionMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Ensure default records exist for About and VisionMission
     */
    private function ensureDefaults()
    {
        About::firstOrCreate(
            ['id' => 1],
            [
                'section_title' => 'Tentang Kami',
                'description' => 'Deskripsi Kota Baru Parahyangan akan ditampilkan di sini',
                'image_path' => null,
                'vision_title' => 'Visi & Misi',
                'vision_content' => 'Visi kami akan ditampilkan di sini',
                'mission_content' => 'Misi kami akan ditampilkan di sini',
            ]
        );

        VisionMission::firstOrCreate(
            ['id' => 1],
            [
                'vision_title' => 'Visi',
                'vision_description' => 'Visi kami akan ditampilkan di sini',
                'mission_title' => 'Misi',
                'mission_description' => 'Misi kami akan ditampilkan di sini',
            ]
        );
    }

    /**
     * Show the about page content.
     */
    public function show()
    {
        $this->ensureDefaults();

        $about = About::first();
        $visionMission = VisionMission::first();

        return view('admin.about.show', compact('about', 'visionMission'));
    }

    /**
     * Show the form for editing the about content.
     */
    public function edit()
    {
        $this->ensureDefaults();

        $about = About::first();
        $visionMission = VisionMission::first();

        return view('admin.about.edit', compact('about', 'visionMission'));
    }

    /**
     * Update the about content in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'section_title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vision_title' => 'required|string|max:255',
            'vision_content' => 'required|string|max:5000',
            'mission_content' => 'required|string|max:5000',
            'vision_mission_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update About
        $about = About::first() ?? new About();

        $about->section_title = trim($validated['section_title']);
        $about->description = trim($validated['description']);
        $about->vision_title = trim($validated['vision_title']);
        $about->vision_content = trim($validated['vision_content']);
        $about->mission_content = trim($validated['mission_content']);

        // Handle about image upload (delete old image if exists)
        if ($request->hasFile('image')) {
            if ($about->image_path && Storage::disk('public')->exists($about->image_path)) {
                Storage::disk('public')->delete($about->image_path);
            }
            $path = $request->file('image')->store('about', 'public');
            $about->image_path = $path;
        }

        // Handle vision mission image upload (delete old image if exists)
        if ($request->hasFile('vision_mission_image')) {
            if ($about->vision_mission_image && Storage::disk('public')->exists($about->vision_mission_image)) {
                Storage::disk('public')->delete($about->vision_mission_image);
            }
            $path = $request->file('vision_mission_image')->store('vision-mission', 'public');
            $about->vision_mission_image = $path;
        }

        $about->save();

        return redirect()->route('admin.about.show')
                       ->with('success', 'Tentang Kami & Visi Misi berhasil diupdate');
    }
}
