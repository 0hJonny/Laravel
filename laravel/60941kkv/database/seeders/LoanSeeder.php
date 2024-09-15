<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loans')->insert([
            [
                'loan_copy_id' => 1,
                'loan_date' => '2024-09-15 12:10:14',
                'loan_reader_id' => 1,
                'loan_return_date' => null, // Если фактическая дата возврата еще не известна
                'loan_return_date_plan' => '2024-09-29 12:10:14'
            ],
            [
                'loan_copy_id' => 2,
                'loan_date' => '2024-09-05 12:10:14',
                'loan_reader_id' => 2,
                'loan_return_date' => null, // Если фактическая дата возврата еще не известна
                'loan_return_date_plan' => '2024-09-19 12:10:14'
            ],
            [
                'loan_copy_id' => 3,
                'loan_date' => '2024-08-15 12:10:14',
                'loan_reader_id' => 3,
                'loan_return_date' => null, // Если фактическая дата возврата еще не известна
                'loan_return_date_plan' => '2024-08-29 12:10:14'
            ],
            [
                'loan_copy_id' => 4,
                'loan_date' => '2024-08-05 12:10:14',
                'loan_reader_id' => 4,
                'loan_return_date' => null, // Если фактическая дата возврата еще не известна
                'loan_return_date_plan' => '2024-08-19 12:10:14'
            ],
        ]);
    }
}
