<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['Administrator', 'Farm Staff', 'Accountant', 'Viewer'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $admin = User::factory()->create([
            'name' => 'Danny Admin',
            'email' => 'admin@duckfarm.local',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('Administrator');
    }
}
