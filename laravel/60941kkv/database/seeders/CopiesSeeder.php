<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CopiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('copies')->insert([
            [
                'copy_inventory_number' => '14914w',
                'copy_publication_id' => 1,  // ID публикации из таблицы publications
                'copy_condition_id' => 1,  // ID состояния книги из таблицы book_conditions
                'copy_reader_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'copy_inventory_number' => '14914x',
                'copy_publication_id' => 2,  // ID публикации из таблицы publications
                'copy_condition_id' => 2,  // ID состояния книги из таблицы book_conditions
                'copy_reader_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'copy_inventory_number' => '14914y',
                'copy_publication_id' => 3,
                'copy_condition_id' => 3,
                'copy_reader_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'copy_inventory_number' => '14914z',
                'copy_publication_id' => 4,
                'copy_condition_id' => 4,
                'copy_reader_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'copy_inventory_number' => '14915a',
                'copy_publication_id' => 5,
                'copy_condition_id' => 1,
                'copy_reader_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'copy_inventory_number' => '14915b',
                'copy_publication_id' => 6,
                'copy_condition_id' => 2,
                'copy_reader_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'copy_inventory_number' => '14915c',
                'copy_publication_id' => 7,
                'copy_condition_id' => 3,
                'copy_reader_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
