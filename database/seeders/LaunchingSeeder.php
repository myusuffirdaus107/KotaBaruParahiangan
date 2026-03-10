<?php

namespace Database\Seeders;

use App\Models\Launching;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaunchingSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $launchings = [
            [
                'title' => 'Tatar Bungawari',
                'slug' => 'tatar-bungawari',
                'description' => 'Hunian eksklusif dengan konsep modern minimalis, dilengkapi dengan fasilitas lengkap dan akses mudah ke berbagai pusat bisnis. Desain interior yang elegan dengan teknologi smart home terkini menghadirkan kenyamanan maksimal untuk keluarga Anda.',
                'image' => 'launchings/launching-1.jpg',
                'location' => 'Jl. Sudirman, Kotabaru',
                'developer' => 'PT Kotabaru Property',
                'launch_date' => now()->format('Y-m-d'),
                'status' => 'active',
            ],
            [
                'title' => 'Sentosa Grand Estate',
                'slug' => 'sentosa-grand-estate',
                'description' => 'Kompleks perumahan mewah dengan arsitektur Eropa, taman yang indah, dan fasilitas premium untuk keluarga Anda. Setiap unit dirancang dengan detail sempurna untuk memberikan pengalaman hidup yang istimewa.',
                'image' => 'launchings/launching-2.jpg',
                'location' => 'Jl. Ahmad Yani, Kotabaru',
                'developer' => 'PT Kotabaru Property',
                'launch_date' => now()->format('Y-m-d'),
                'status' => 'active',
            ],
            [
                'title' => 'Citra Mega Premier',
                'slug' => 'citra-mega-premier',
                'description' => 'Hunian premium dengan teknologi smart home, interior mewah, dan lokasi premium di pusat kota. Nikmati gaya hidup modern dengan fasilitas world-class dan akses mudah ke berbagai destinasi.',
                'image' => 'launchings/launching-3.jpg',
                'location' => 'Jl. Gatot Subroto, Kotabaru',
                'developer' => 'PT Kotabaru Property',
                'launch_date' => now()->format('Y-m-d'),
                'status' => 'active',
            ],
        ];

        foreach ($launchings as $launching) {
            Launching::firstOrCreate(['slug' => $launching['slug']], $launching);
        }
    }
}
