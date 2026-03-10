<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

echo "=== CATEGORIES ===\n";
$categories = \App\Models\Category::all();
foreach($categories as $c) {
    echo $c->id . ": " . $c->name . "\n";
}

echo "\n=== PROPERTIES ===\n";
$props = \App\Models\Property::all();
foreach($props as $p) {
    echo $p->id . ": " . $p->title . " (cat_id: " . $p->category_id . ")\n";
}

echo "\n=== UPDATE: Link properties to Business/Hunian ===\n";
$business = \App\Models\Category::where('slug', 'business')->first();
$hunian = \App\Models\Category::where('slug', 'hunian')->first();

if(!$business || !$hunian) {
    echo "ERROR: Categories not found\n";
    exit;
}

// Get all locations
$businessLocs = ['Business Park Kotabaru', 'Tech Center Kotabaru', 'Commerce Plaza'];
$hunianLocs = ['Taman Indah Residence', 'Sentosa Garden City', 'Citra Mega Residence'];

// Update properties
foreach($businessLocs as $title) {
    $prop = \App\Models\Property::where('title', $title)->first();
    if($prop) {
        $prop->update(['category_id' => $business->id]);
        echo "✓ Updated: " . $title . "\n";
    }
}

foreach($hunianLocs as $title) {
    $prop = \App\Models\Property::where('title', $title)->first();
    if($prop) {
        $prop->update(['category_id' => $hunian->id]);
        echo "✓ Updated: " . $title . "\n";
    }
}

echo "\n=== FINAL CHECK ===\n";
$props = \App\Models\Property::with('category')->get();
foreach($props as $p) {
    echo $p->title . " → " . ($p->category->name ?? 'NO CATEGORY') . "\n";
}
?>
