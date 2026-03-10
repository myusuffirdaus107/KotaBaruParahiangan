<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hunianCategory = Category::where('slug', 'hunian')->first();
        $businessCategory = Category::where('slug', 'business')->first();

        // Hunian Properties
        if ($hunianCategory) {
            $hunianProperties = [
                [
                    'title' => 'Taman Indah Residence',
                    'slug' => 'taman-indah-residence',
                    'category_id' => $hunianCategory->id,
                    'price' => 500000000,
                    'location' => 'Jl. Sudirman, Kotabaru',
                    'description' => 'Hunian modern dengan desain minimalis, dilengkapi dengan fasilitas lengkap seperti taman bermain, area olahraga, dan keamanan 24 jam. Lokasi strategis dekat dengan sekolah dan pusat bisnis.',
                    'status' => 'available',
                    'featured' => true,
                    'brochure' => null,
                ],
                [
                    'title' => 'Sentosa Garden City',
                    'slug' => 'sentosa-garden-city',
                    'category_id' => $hunianCategory->id,
                    'price' => 650000000,
                    'location' => 'Jl. Ahmad Yani, Kotabaru',
                    'description' => 'Komplek perumahan eksklusif dengan arsitektur Eropa, taman yang asri, dan komunitas yang solid. Dilengkapi dengan kolam renang, lapangan olahraga, dan area hijau yang luas.',
                    'status' => 'available',
                    'featured' => true,
                    'brochure' => null,
                ],
                [
                    'title' => 'Citra Mega Residence',
                    'slug' => 'citra-mega-residence',
                    'category_id' => $hunianCategory->id,
                    'price' => 750000000,
                    'location' => 'Jl. Gatot Subroto, Kotabaru',
                    'description' => 'Hunian premium dengan konsep smart home, interior mewah, dan lokasi premium dekat dengan pusat kota. Fasilitas lengkap termasuk gym, kolam renang, dan area bermain anak.',
                    'status' => 'available',
                    'featured' => true,
                    'brochure' => null,
                ],
            ];

            foreach ($hunianProperties as $property) {
                Property::firstOrCreate(['slug' => $property['slug']], $property);
            }
        }

        // Business Properties
        if ($businessCategory) {
            $businessProperties = [
                [
                    'title' => 'Business Park Kotabaru',
                    'slug' => 'business-park-kotabaru',
                    'category_id' => $businessCategory->id,
                    'price' => 2500000000,
                    'location' => 'Jl. Diponegoro, Kotabaru',
                    'description' => 'Ruang bisnis modern dengan fasilitas kelas A, akses mudah ke bandara dan pusat bisnis, dilengkapi dengan parking basement, security 24/7, dan ruang meeting yang profesional.',
                    'status' => 'available',
                    'featured' => true,
                    'brochure' => null,
                ],
                [
                    'title' => 'Tech Center Kotabaru',
                    'slug' => 'tech-center-kotabaru',
                    'category_id' => $businessCategory->id,
                    'price' => 3000000000,
                    'location' => 'Jl. Merdeka, Kotabaru',
                    'description' => 'Pusat teknologi dan inovasi dengan infrastruktur internet berkecepatan tinggi, incubator startup, dan komunitas bisnis yang dinamis. Cocok untuk startup dan perusahaan tech scale-up.',
                    'status' => 'available',
                    'featured' => true,
                    'brochure' => null,
                ],
                [
                    'title' => 'Commerce Plaza',
                    'slug' => 'commerce-plaza',
                    'category_id' => $businessCategory->id,
                    'price' => 1800000000,
                    'location' => 'Jl. Imam Bonjol, Kotabaru',
                    'description' => 'Pusat perdagangan dengan lokasi strategis, lalu lintas tinggi, dan tenant mix yang bagus. Ideal untuk retail, F&B, atau showroom dengan akses mudah dari semua arah.',
                    'status' => 'available',
                    'featured' => true,
                    'brochure' => null,
                ],
            ];

            foreach ($businessProperties as $property) {
                Property::firstOrCreate(['slug' => $property['slug']], $property);
            }
        }
    }
}
