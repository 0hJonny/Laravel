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
            ['book_wear_coefficient_name' => 'Плохо'],
            ['book_wear_coefficient_name' => 'Неудовлетворительно'],
            ['book_wear_coefficient_name' => 'Удовлетворительно'],
            ['book_wear_coefficient_name' => 'Хорошо'],
            ['book_wear_coefficient_name' => 'Отлично'],
            ['book_wear_coefficient_name' => 'Новый'],
            ['book_wear_coefficient_name' => 'Идеальное'],
        ]);
    }
}
