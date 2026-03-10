<?php

namespace App\Http\Controllers\Admin;

use App\Models\VisionMission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisionMissionController extends Controller
{
    /**
     * Show the vision mission content
     */
    public function show()
    {
        $visionMission = VisionMission::firstOrCreate(
            ['id' => 1],
            [
                'vision_title' => 'Visi',
                'vision_description' => 'Visi kami akan ditampilkan di sini',
                'mission_title' => 'Misi',
                'mission_description' => 'Misi kami akan ditampilkan di sini',
            ]
        );

        return view('admin.vision-mission.show', compact('visionMission'));
    }

    /**
     * Show the form for editing the vision mission
     */
    public function edit()
    {
        $visionMission = VisionMission::firstOrCreate(
            ['id' => 1],
            [
                'vision_title' => 'Visi',
                'vision_description' => 'Visi kami akan ditampilkan di sini',
                'mission_title' => 'Misi',
                'mission_description' => 'Misi kami akan ditampilkan di sini',
            ]
        );

        return view('admin.vision-mission.edit', compact('visionMission'));
    }

    /**
     * Update the vision mission in database
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'vision_title' => 'required|string|max:255',
            'vision_description' => 'required|string',
            'mission_title' => 'required|string|max:255',
            'mission_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $visionMission = VisionMission::find(1);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('vision-mission', 'public');
            $validated['image'] = $path;
        }

        $visionMission->update($validated);

        return redirect()->route('admin.vision-mission.show')
                       ->with('success', 'Visi & Misi berhasil diperbarui!');
    }
}
