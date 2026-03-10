<?php
// Quick script to link properties to correct categories
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

use App\Models\Category;
use App\Models\Property;

// Get categories
$business = Category::where('slug', 'business')->first();
$hunian = Category::where('slug', 'hunian')->first();

if(!$business || !$hunian) {
    die("ERROR: Categories not found!");
}

echo "Business ID: " . $business->id . "\n";
echo "Hunian ID: " . $hunian->id . "\n\n";

// Business properties
$businessProps = [
    'Business Park Kotabaru',
    'Tech Center Kotabaru',
    'Commerce Plaza'
];

// Hunian properties
$hunianProps = [
    'Taman Indah Residence',
    'Sentosa Garden City',
    'Citra Mega Residence'
];

echo "=== UPDATING BUSINESS PROPERTIES ===\n";
foreach($businessProps as $title) {
    $prop = Property::where('title', $title)->first();
    if($prop) {
        $prop->category_id = $business->id;
        $prop->save();
        echo "✓ " . $title . " → Business\n";
    } else {
        echo "✗ " . $title . " NOT FOUND\n";
    }
}

echo "\n=== UPDATING HUNIAN PROPERTIES ===\n";
foreach($hunianProps as $title) {
    $prop = Property::where('title', $title)->first();
    if($prop) {
        $prop->category_id = $hunian->id;
        $prop->save();
        echo "✓ " . $title . " → Hunian\n";
    } else {
        echo "✗ " . $title . " NOT FOUND\n";
    }
}

echo "\n=== FINAL DATA ===\n";
$props = Property::with('category')->orderBy('id')->get();
foreach($props as $p) {
    echo $p->title . " → " . ($p->category->name ?? 'NO CAT') . "\n";
}
?>
