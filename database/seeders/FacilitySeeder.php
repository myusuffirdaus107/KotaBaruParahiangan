<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\FacilityItem;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'title' => 'Wisata Pendidikan',
                'slug' => 'wisata-pendidikan',
                'icon' => 'fas fa-graduation-cap',
                'description' => 'Fasilitas wisata pendidikan yang menarik dan edukatif untuk semua usia di Kota Baru Parahyangan.',
                'order' => 1,
                'is_active' => true,
                'items' => [
                    ['name' => 'Sundial Puspa Iptek', 'description' => 'Pusat sains dan teknologi interaktif', 'image' => 'https://images.unsplash.com/photo-1427504494785-cdec41d2e321?w=500&h=300&fit=crop'],
                    ['name' => 'Museum Kota', 'description' => 'Museum sejarah dan budaya lokal', 'image' => 'https://images.unsplash.com/photo-1564399579545-e1f8c5e6fdf4?w=500&h=300&fit=crop'],
                    ['name' => 'Taman Edukatif', 'description' => 'Taman pembelajaran outdoor untuk anak-anak', 'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=500&h=300&fit=crop'],
                ]
            ],
            [
                'title' => 'Kesehatan',
                'slug' => 'kesehatan',
                'icon' => 'fas fa-hospital',
                'description' => 'Fasilitas kesehatan lengkap dengan peralatan modern dan tenaga medis profesional.',
                'order' => 2,
                'is_active' => true,
                'items' => [
                    ['name' => 'Rumah Sakit Utama', 'description' => 'Rumah sakit dengan layanan 24 jam', 'image' => 'https://images.unsplash.com/photo-1576091160550-112173f7f869?w=500&h=300&fit=crop'],
                    ['name' => 'Klinik Kesehatan', 'description' => 'Klinik umum dan spesialis', 'image' => 'https://images.unsplash.com/photo-1631217314831-c6227db76b6e?w=500&h=300&fit=crop'],
                    ['name' => 'Apotek Lengkap', 'description' => 'Apotek dengan obat lengkap dan konsultasi farmasi', 'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde0d?w=500&h=300&fit=crop'],
                ]
            ],
            [
                'title' => 'Rekreasi',
                'slug' => 'rekreasi',
                'icon' => 'fas fa-tree',
                'description' => 'Berbagai wahana rekreasi keluarga untuk mengisi waktu luang dengan menyenangkan.',
                'order' => 3,
                'is_active' => true,
                'items' => [
                    ['name' => 'Taman Hiburan', 'description' => 'Wahana permainan keluarga yang aman', 'image' => 'https://images.unsplash.com/photo-1533900298318-6b8da08a523e?w=500&h=300&fit=crop'],
                    ['name' => 'Kolam Renang', 'description' => 'Fasilitas kolam renang Olympic size', 'image' => 'https://images.unsplash.com/photo-1576610616656-d3aa5d1f4fab?w=500&h=300&fit=crop'],
                    ['name' => 'Area Piknik', 'description' => 'Area piknik dengan pemandangan alam yang indah', 'image' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=500&h=300&fit=crop'],
                ]
            ],
            [
                'title' => 'Hotel',
                'slug' => 'hotel',
                'icon' => 'fas fa-bed',
                'description' => 'Akomodasi hotel berbintang dengan fasilitas lengkap dan pelayanan terbaik.',
                'order' => 4,
                'is_active' => true,
                'items' => [
                    ['name' => 'Hotel Bintang 5', 'description' => 'Hotel mewah dengan semua fasilitas premium', 'image' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=500&h=300&fit=crop'],
                    ['name' => 'Hotel Bintang 3', 'description' => 'Hotel standar dengan harga terjangkau', 'image' => 'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=500&h=300&fit=crop'],
                    ['name' => 'Resort & Spa', 'description' => 'Resort dengan spa dan wellness center', 'image' => 'https://images.unsplash.com/photo-1598065046519-c8e979f59922?w=500&h=300&fit=crop'],
                ]
            ],
            [
                'title' => 'Fasilitas Umum',
                'slug' => 'fasilitas-umum',
                'icon' => 'fas fa-hammer',
                'description' => 'Fasilitas umum publik untuk mendukung kehidupan sehari-hari masyarakat.',
                'order' => 5,
                'is_active' => true,
                'items' => [
                    ['name' => 'Transportasi Publik', 'description' => 'Angkutan umum yang nyaman dan terjangkau', 'image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=500&h=300&fit=crop'],
                    ['name' => 'Pasar Modern', 'description' => 'Pasar hibrid dengan standar higienis tinggi', 'image' => 'https://images.unsplash.com/photo-1534946827236-ddc1dd12c3f8?w=500&h=300&fit=crop'],
                    ['name' => 'Utilitas Air & Listrik', 'description' => 'Sistem penyediaan air dan listrik 24 jam', 'image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=500&h=300&fit=crop'],
                ]
            ],
            [
                'title' => 'Pembelanjaan',
                'slug' => 'pembelanjaan',
                'icon' => 'fas fa-shopping-cart',
                'description' => 'Pusat perbelanjaan modern dengan berbagai pilihan toko dan restoran.',
                'order' => 6,
                'is_active' => true,
                'items' => [
                    ['name' => 'Mall Modern', 'description' => 'Pusat perbelanjaan dengan brand internasional', 'image' => 'https://images.unsplash.com/photo-1555636222-cae831c20f61?w=500&h=300&fit=crop'],
                    ['name' => 'Pasar Tradisional', 'description' => 'Pasar dengan produk lokal dan organik', 'image' => 'https://images.unsplash.com/photo-1488459716781-6918f6066781?w=500&h=300&fit=crop'],
                    ['name' => 'Outlet Store', 'description' => 'Toko outlet dengan harga spesial', 'image' => 'https://images.unsplash.com/photo-1572883454114-1ef2afee6e85?w=500&h=300&fit=crop'],
                ]
            ],
            [
                'title' => 'Bank / ATM',
                'slug' => 'bank-atm',
                'icon' => 'fas fa-university',
                'description' => 'Layanan perbankan lengkap dengan mesin ATM tersebar di berbagai lokasi.',
                'order' => 7,
                'is_active' => true,
                'items' => [
                    ['name' => 'Bank Nasional', 'description' => 'Kantor cabang bank terkemuka', 'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=500&h=300&fit=crop'],
                    ['name' => 'ATM Center', 'description' => 'Kelompok ATM dengan berbagai bank', 'image' => 'https://images.unsplash.com/photo-1556740738-b6a63e27c4df?w=500&h=300&fit=crop'],
                    ['name' => 'Money Changer', 'description' => 'Layanan tukar uang asing', 'image' => 'https://images.unsplash.com/photo-1576597587815-fd5d7fcb2c4c?w=500&h=300&fit=crop'],
                ]
            ],
            [
                'title' => 'Pendidikan',
                'slug' => 'pendidikan',
                'icon' => 'fas fa-book',
                'description' => 'Lembaga pendidikan dari TK hingga universitas dengan standar pendidikan internasional.',
                'order' => 8,
                'is_active' => true,
                'items' => [
                    ['name' => 'Universitas Modern', 'description' => 'Kampus dengan fasilitas akademis terlengkap', 'image' => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?w=500&h=300&fit=crop'],
                    ['name' => 'Sekolah Menengah', 'description' => 'SMP dan SMA dengan kurikulum internasional', 'image' => 'https://images.unsplash.com/photo-1427504494785-cdec41d2e321?w=500&h=300&fit=crop'],
                    ['name' => 'Sekolah Dasar', 'description' => 'SD dengan metode pembelajaran progresif', 'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=500&h=300&fit=crop'],
                ]
            ],
            [
                'title' => 'Olahraga',
                'slug' => 'olahraga',
                'icon' => 'fas fa-dumbbell',
                'description' => 'Fasilitas olahraga lengkap untuk mendukung gaya hidup sehat dan aktif.',
                'order' => 9,
                'is_active' => true,
                'items' => [
                    ['name' => 'Gym & Fitness', 'description' => 'Pusat kebugaran dengan peralatan modern', 'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=500&h=300&fit=crop'],
                    ['name' => 'Lapangan Olahraga', 'description' => 'Lapangan sepak bola, basket, dan tenis', 'image' => 'https://images.unsplash.com/photo-1458704899121-25af97ff7d6e?w=500&h=300&fit=crop'],
                    ['name' => 'Stadion Olahraga', 'description' => 'Stadion dengan kapasitas 5000 penonton', 'image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=500&h=300&fit=crop'],
                ]
            ],
            [
                'title' => 'Kuliner',
                'slug' => 'kuliner',
                'icon' => 'fas fa-utensils',
                'description' => 'Berbagai pilihan restoran dan cafe dengan kualitas tinggi dan cita rasa internasional.',
                'order' => 10,
                'is_active' => true,
                'items' => [
                    ['name' => 'Restoran Fine Dining', 'description' => 'Restoran mewah dengan chef internasional', 'image' => 'https://images.unsplash.com/photo-1504674900967-a8d32fbd3035?w=500&h=300&fit=crop'],
                    ['name' => 'Food Court', 'description' => 'Pusat makanan dengan berbagai pilihan masakan', 'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561615?w=500&h=300&fit=crop'],
                    ['name' => 'Cafe & Bistro', 'description' => 'Kafe santai dengan suasana nyaman', 'image' => 'https://images.unsplash.com/photo-1442512595331-e89e30266358?w=500&h=300&fit=crop'],
                ]
            ],
        ];

        foreach ($facilities as $data) {
            $items = $data['items'];
            unset($data['items']);

            $facility = Facility::create($data);

            foreach ($items as $index => $item) {
                $item['facility_id'] = $facility->id;
                $item['order'] = $index + 1;
                FacilityItem::create($item);
            }
        }
    }
}
