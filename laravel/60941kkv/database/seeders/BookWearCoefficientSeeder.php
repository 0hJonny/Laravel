<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookWearCoefficientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('book_wear_coefficients')->insert([
            [
                'book_wear_coefficient_name' => 'Новое',
                'book_wear_coefficient_order' => 1,
            ],
            [
                'book_wear_coefficient_name' => 'Хорошее',
                'book_wear_coefficient_order' => 2,
            ],
            [
                'book_wear_coefficient_name' => 'Удовлетворительное',
                'book_wear_coefficient_order' => 3,
            ],
            [
                'book_wear_coefficient_name' => 'Плохое',
                'book_wear_coefficient_order' => 4,
            ],
        ]);
    }
}
