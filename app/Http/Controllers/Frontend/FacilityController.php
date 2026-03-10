<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function show($slug)
    {
        $facility = Facility::where('slug', $slug)
            ->where('is_active', true)
            ->with('facilityItems')
            ->firstOrFail();

        $pageTitle = $facility->title . ' - Properti Kotabaru';

        return view('frontend.facility', compact('facility', 'pageTitle'));
    }
}
