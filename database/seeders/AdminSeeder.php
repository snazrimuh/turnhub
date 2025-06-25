<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan admin dengan email dan password
        Admin::create([
            'email' => 'turnhub.id@gmail.com',
            'password' => Hash::make('turnhubkwu'),
        ]);
    }
}

