<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // firstOrCreate: kalau emailnya sudah ada, tidak dibuat dobel
        Admin::firstOrCreate(
            ['email' => 'admin@edukasigender.test'],
            ['username' => 'Admin', 'password' => Hash::make('Admin12345')]
        );
    }
}