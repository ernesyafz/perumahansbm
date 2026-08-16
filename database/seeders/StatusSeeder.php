<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        Status::updateOrCreate(
            ['name' => 'Tersedia'],
            ['badge_class' => 'bg-success text-white']
        );

        Status::updateOrCreate(
            ['name' => 'Terbatas'],
            ['badge_class' => 'bg-warning text-dark']
        );

        Status::updateOrCreate(
            ['name' => 'Habis'],
            ['badge_class' => 'bg-danger text-white']
        );
    }
}
