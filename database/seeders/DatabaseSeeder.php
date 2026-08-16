<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AgentSeeder;
use Database\Seeders\ClusterSeeder;
use Database\Seeders\StatusSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StatusSeeder::class,
            ClusterSeeder::class,
            AgentSeeder::class,
        ]);

        // User::factory(10)->create();
        User::firstOrCreate(
            ['email' => 'admin@sbm.test'],
            [
                'name' => 'Admin SBM',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );
    }
}
