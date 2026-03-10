<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Selamat Datang ke Properti Kotabaru',
                'subtitle' => 'Properti Impian Anda Dimulai Di Sini',
                'image' => 'sliders/slider-1.jpg',
                'link' => '/',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Properti Berkualitas Premium',
                'subtitle' => 'Dengan Harga Terjangkau dan Lokasi Strategis',
                'image' => 'sliders/slider-2.jpg',
                'link' => '/hunian',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Investasi Properti Terbaik',
                'subtitle' => 'Raih Peluang Bisnis Emas Bersama Kami',
                'image' => 'sliders/slider-3.jpg',
                'link' => '/business',
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::firstOrCreate(['title' => $slider['title']], $slider);
        }
    }
}
