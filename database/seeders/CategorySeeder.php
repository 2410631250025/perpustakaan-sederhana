<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Fiksi',
                'description' => 'Buku novel dan cerita fiksi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pendidikan',
                'description' => 'Buku pembelajaran dan pengetahuan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sejarah',
                'description' => 'Buku tentang sejarah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}