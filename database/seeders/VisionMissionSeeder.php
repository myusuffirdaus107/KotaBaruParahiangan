<?php

namespace Database\Seeders;

use App\Models\VisionMission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisionMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VisionMission::firstOrCreate(
            ['id' => 1],
            [
                'vision_title' => 'Visi',
                'vision_description' => 'Visi kami akan ditampilkan di sini',
                'mission_title' => 'Misi',
                'mission_description' => 'Misi kami akan ditampilkan di sini',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&h=600&fit=crop',
            ]
        );
    }
}
