<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'FitLife Gear',
            'email'    => 'fitlife@example.com',
            'password' => Hash::make('password'),
            'role'     => 'brand',
        ]);

        User::create([
            'name'     => 'EcoWear',
            'email'    => 'ecowear@example.com',
            'password' => Hash::make('password'),
            'role'     => 'brand',
        ]);

        User::create([
            'name'     => 'ChefMate',
            'email'    => 'chefmate@example.com',
            'password' => Hash::make('password'),
            'role'     => 'brand',
        ]);
    }
}
