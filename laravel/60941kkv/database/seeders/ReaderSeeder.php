<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('readers')->insert([
            [
                'reader_name' => 'Иван',
                'reader_surname' => 'Иванов',
                'reader_middle_name' => 'Иванович',
                'reader_user_id' => 1, // ID пользователя Иван Иванов
            ],
            [
                'reader_name' => 'Петр',
                'reader_surname' => 'Петров',
                'reader_middle_name' => 'Петрович',
                'reader_user_id' => 2, // ID пользователя Петр Петров
            ],
            [
                'reader_name' => 'Сергей',
                'reader_surname' => 'Сергеев',
                'reader_middle_name' => 'Сергеевич',
                'reader_user_id' => 3, // ID пользователя Сергей Сергеев
            ],
            [
                'reader_name' => 'Алексей',
                'reader_surname' => 'Алексеев',
                'reader_middle_name' => 'Алексеевич',
                'reader_user_id' => 4, // ID пользователя Алексей Алексеев
            ],
            [
                'reader_name' => 'Михаил',
                'reader_surname' => 'Михайлов',
                'reader_middle_name' => 'Михайлович',
                'reader_user_id' => 5, // ID пользователя Михаил Михайлов
            ],
            [
                'reader_name' => 'Николай',
                'reader_surname' => 'Николаев',
                'reader_middle_name' => 'Николаевич',
                'reader_user_id' => 6, // ID пользователя Николай Николаев
            ],
            [
                'reader_name' => 'Константин',
                'reader_surname' => 'Константинов',
                'reader_middle_name' => 'Константинович',
                'reader_user_id' => 7, // ID пользователя Константин Константинов
            ],
            [
                'reader_name' => 'Даниил',
                'reader_surname' => 'Даниилов',
                'reader_middle_name' => 'Даниилович',
                'reader_user_id' => 8, // ID пользователя Даниил Даниилов
            ],
        ]);
    }
}
