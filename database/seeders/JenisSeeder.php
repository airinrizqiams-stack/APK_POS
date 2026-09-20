<?php

namespace Database\Seeders;

use App\Models\Jenis;
use App\Models\User;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::value('id') ?? 1;

        $categories = [
            'Makanan',
            'Minuman',
            'Pakaian',
            'Elektronik',
            'Sembako'
        ];

        foreach ($categories as $category) {
            Jenis::firstOrCreate(
                ['nama_jenis' => $category],
                ['user_id' => $userId]
            );
        }
    }
}