<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkPropertiesToCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $business = Category::where('slug', 'business')->first();
        $hunian = Category::where('slug', 'hunian')->first();

        if (!$business || !$hunian) {
            echo "ERROR: Categories not found!\n";
            return;
        }

        // Link Business properties
        $businessTitles = [
            'Business Park Kotabaru',
            'Tech Center Kotabaru',
            'Commerce Plaza'
        ];

        foreach ($businessTitles as $title) {
            Property::where('title', $title)
                ->update(['category_id' => $business->id]);
            echo "✓ Updated: $title → Business\n";
        }

        // Link Hunian properties
        $hunianTitles = [
            'Taman Indah Residence',
            'Sentosa Garden City',
            'Citra Mega Residence'
        ];

        foreach ($hunianTitles as $title) {
            Property::where('title', $title)
                ->update(['category_id' => $hunian->id]);
            echo "✓ Updated: $title → Hunian\n";
        }

        echo "\nAll properties have been categorized successfully!\n";
    }
}
?>
