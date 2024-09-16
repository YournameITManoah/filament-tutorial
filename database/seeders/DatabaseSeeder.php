<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use App\Models\TimeLog;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);

        Client::factory(10)
            ->has(Project::factory(3)
                ->has(User::factory(5))
            )
            ->create();
    }
}
