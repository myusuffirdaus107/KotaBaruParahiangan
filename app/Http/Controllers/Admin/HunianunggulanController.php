<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HunianUnggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HunianUnggulanController extends Controller
{
    public function show()
    {
        $hunian = HunianUnggulan::getInstance();
        return view('admin.hunian-unggulan.show', compact('hunian'));
    }

    public function edit()
    {
        $hunian = HunianUnggulan::getInstance();
        return view('admin.hunian-unggulan.edit', compact('hunian'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'property_name' => 'required|string|max:255',
            'tatar_name'    => 'nullable|string|max:255',
            'location'      => 'nullable|string|max:255',
            'badge_label'   => 'nullable|string|max:80',
            'cicilan_harga' => 'nullable|numeric|min:0',
            'cicilan_unit'  => 'nullable|string|max:50',
            'price_note'    => 'nullable|string|max:255',
            'image'         => 'nullable|image|max:5120',
        ]);

        $hunian = HunianUnggulan::getInstance();

        $data = $request->only([
            'property_name', 'tatar_name', 'location',
            'badge_label', 'cicilan_harga', 'cicilan_unit', 'price_note',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($hunian->image) {
                Storage::disk('public')->delete($hunian->image);
            }
            $data['image'] = $request->file('image')->store('hunian_unggulan', 'public');
        }

        // Handle image delete
        if ($request->boolean('delete_image') && $hunian->image) {
            Storage::disk('public')->delete($hunian->image);
            $data['image'] = null;
        }

        // Parse benefits (max 4, skip baris kosong)
        $titles  = $request->input('benefit_title', []);
        $values  = $request->input('benefit_value', []);
        $benefits = [];
        foreach ($titles as $i => $title) {
            $title = trim($title);
            if ($title !== '') {
                $benefits[] = ['title' => $title, 'value' => trim($values[$i] ?? '')];
            }
            if (count($benefits) >= 4) break;
        }
        $data['benefits'] = $benefits;

        $hunian->update($data);

        return redirect()->route('admin.hunian-unggulan.show')
            ->with('success', 'Hunian Unggulan berhasil diperbarui.');
    }
}