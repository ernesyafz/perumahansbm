<?php

namespace Database\Seeders;

use App\Models\Cluster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClusterSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Cluster::updateOrCreate(
            ['name' => 'Cluster Akasia'],
            [
                'status_id' => 1,
                'type' => 'Tipe 36/72',
                'price' => 450000000,
                'land_area' => 72,
                'building_area' => 36,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'carport' => 1,
                'description' => 'Hunian minimalis modern yang cocok untuk keluarga baru. Dilengkapi sisa lahan di bagian belakang.',
                'feature_summary' => 'Sirkulasi udara alami, finishing modern, dan desain compact ideal untuk keluarga muda.',
                'image_url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
            ]
        );

        Cluster::updateOrCreate(
            ['name' => 'Cluster Mahoni'],
            [
                'status_id' => 1,
                'type' => 'Tipe 45/90',
                'price' => 600000000,
                'land_area' => 90,
                'building_area' => 45,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'carport' => 1,
                'description' => 'Ruang keluarga yang lebih lega dengan pencahayaan alami maksimal dan sirkulasi udara yang baik.',
                'feature_summary' => 'Pencahayaan alami maksimal, desain fleksibel, dan akses langsung ke area hijau.',
                'image_url' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=800&q=80',
            ]
        );

        Cluster::updateOrCreate(
            ['name' => 'Cluster Cendana'],
            [
                'status_id' => 2,
                'type' => 'Tipe 70/120',
                'price' => 950000000,
                'land_area' => 120,
                'building_area' => 70,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'carport' => 2,
                'description' => 'Rumah premium 2 lantai dengan ruang ekstra dan carport ganda.',
                'feature_summary' => 'Desain premium 2 lantai, area servis luas, dan ruang keluarga terbagi untuk kenyamanan ekstra.',
                'image_url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
            ]
        );
    }
}
