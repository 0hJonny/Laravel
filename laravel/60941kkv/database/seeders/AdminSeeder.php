<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        
        if (!$adminRole) {
            throw new \Exception('Admin role not found. Run RoleSeeder first.');
        }

        User::create([
            'user_name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role_id' => 1,
        ]);
    }
}
