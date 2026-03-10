<?php

namespace Database\Seeders;

use App\Models\HomeSection;
use App\Models\HomeImage;
use App\Models\HomeFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Experience Card Section
        $section = HomeSection::firstOrCreate(
            ['title' => 'Experience your Expansive Living Spaces'],
            [
                'subtitle' => null,
                'description' => null,
                'is_active' => true,
                'order' => 1,
            ]
        );

        // Add images (if not exists)
        if ($section->images()->count() === 0) {
            HomeImage::create([
                'home_section_id' => $section->id,
                'image_path' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400&h=350&fit=crop',
                'alt_text' => 'Interior 1',
                'order' => 1,
            ]);

            HomeImage::create([
                'home_section_id' => $section->id,
                'image_path' => 'https://images.unsplash.com/photo-1600585152220-90363fe7e115?w=200&h=170&fit=crop',
                'alt_text' => 'Interior 2',
                'order' => 2,
            ]);

            HomeImage::create([
                'home_section_id' => $section->id,
                'image_path' => 'https://images.unsplash.com/photo-1600210174810-92d3e559e3a5?w=200&h=170&fit=crop',
                'alt_text' => 'Interior 3',
                'order' => 3,
            ]);
        }

        // Add features (if not exists)
        if ($section->features()->count() === 0) {
            $features = [
                '✓ Free PPN 100%',
                '✓ Soft DP',
                '✓ Free Canopy',
                '✓ Free Smart Door Lock',
                '✓ Free Smarthome System',
                '✓ Free Logam Mulia up to 15gr',
                '✓ Free Mobil BYD Seal*',
                '✓ Free Motor Alva Cervo*',
            ];

            foreach ($features as $index => $featureText) {
                HomeFeature::create([
                    'home_section_id' => $section->id,
                    'feature_text' => $featureText,
                    'order' => $index + 1,
                ]);
            }
        }
    }
}
