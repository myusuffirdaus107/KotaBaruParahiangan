<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Display inquiries.
     */
    public function index()
    {
        $inquiries = Inquiry::with('property')->latest()->paginate(15);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    /**
     * Show inquiry details.
     */
    public function show(Inquiry $inquiry)
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    /**
     * Mark inquiry as contacted.
     */
    public function markAsContacted(Inquiry $inquiry)
    {
        $inquiry->update(['is_contacted' => true]);
        return redirect()->back()->with('success', 'Inquiry sudah ditandai sebagai terhubung');
    }

    /**
     * Delete inquiry.
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')
                       ->with('success', 'Inquiry berhasil dihapus');
    }
}
