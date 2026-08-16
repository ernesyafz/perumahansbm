<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Agent::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Fajar Santoso',
                'phone' => '+62 812-3456-7890',
                'whatsapp' => '6281234567890',
                'email' => 'info@sbm.co.id',
                'address' => 'Jl. Harapan Indah No.88, Kecamatan Bekasi Selatan, Jawa Barat',
                'schedule' => 'Senin - Sabtu, 09.00 - 17.00',
                'promo' => 'DP mulai 10%, gratis biaya KPR & notaris*',
                'map_link' => 'https://goo.gl/maps/your-prototype-link',
            ]
        );
    }
}
