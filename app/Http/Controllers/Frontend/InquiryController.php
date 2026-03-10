<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Store a new inquiry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|min:10',
            'subject' => 'nullable|string|max:100',
        ]);

        // Remove subject from validated array if present (since DB doesn't have this column)
        unset($validated['subject']);

        Inquiry::create($validated);

        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah dikirim. Kami akan menghubungi Anda dalam waktu singkat.');
    }
}
