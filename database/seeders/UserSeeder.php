<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\TimeLog;
use App\Models\User;
use App\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(Project::factory(5))
            ->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role_id' => Role::ADMIN
        ]);

        User::factory()
            ->has(Project::factory(5))
            ->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('user'),
            'role_id' => Role::USER,
        ]);
    }
}
