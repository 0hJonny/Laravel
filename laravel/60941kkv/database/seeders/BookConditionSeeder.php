<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class BookConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('book_conditions')->insert([
            [
                'book_condition_name' => 1, // Ссылается на "Новое" из таблицы book_wear_coefficients
                'book_condition_description' => 'Книга в идеальном состоянии, практически не использовалась.',
            ],
            [
                'book_condition_name' => 2, // Ссылается на "Хорошее"
                'book_condition_description' => 'Незначительные следы использования, в хорошем состоянии.',
            ],
            [
                'book_condition_name' => 3, // Ссылается на "Удовлетворительное"
                'book_condition_description' => 'Есть видимые повреждения, но книга читаема.',
            ],
            [
                'book_condition_name' => 4, // Ссылается на "Плохое"
                'book_condition_description' => 'Многочисленные повреждения, требуются реставрационные работы.',
            ],
        ]);
    }
}
