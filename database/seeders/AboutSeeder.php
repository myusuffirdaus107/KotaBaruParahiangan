<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::firstOrCreate(
            ['id' => 1],
            [
                'section_title' => 'Tentang Kami',
                'description' => 'Kota Baru Parahyangan merupakan kota mandiri pertama dan terluas di Bandung (1.250 ha) dimana keunggulan pendidikan mendapat tempat utama sebagai investasi terbaik untuk kemajuan & kesejahteraan masa depan. Pilar pendidikan tersebut diimplementasikan dalam bentuk formal, berupa tersedianya fasilitas pendidikan mulai dari playgroup hingga universitas, maupun dalam bentuk non formal seperti Sundial Puspa Iptek, Bale Seni Barli, dan taman tematik yang tersebar di setiap tatar.',
                'image_path' => null,
                'vision_title' => 'Visi & Misi',
                'vision_content' => 'Menjadi Kota Mandiri yang berkelanjutan
Menciptakan kehidupan berkualitas serta sejahtera bagi penghuni dan masyarakat sekitarnya',
                'mission_content' => 'Kota Baru Parahyangan memiliki misi menciptakan ekosistem kehidupan kota Bandung pada khususnya dan masyarakat umum umumnya untuk dijadikan destinasi wisata, berbelanja, dan tempat tinggal yang menarik serta berkelanjutan.',
            ]
        );
    }
}
