<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'year' => 2005,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bumi',
                'author' => 'Tere Liye',
                'year' => 2014,
                'stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Negeri 5 Menara',
                'author' => 'Ahmad Fuadi',
                'year' => 2009,
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}