<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('publications')->insert([
            [
                'publication_title' => 'Война и Мир',
                'publication_author' => 'Толстой Лев Николаевич',
                'publication_publisher' => 'Русское издательство',
                'publication_date' => '1869-01-01',  // Убедитесь, что используете правильное имя столбца
                'publication_page' => 1225,
                'publication_ISBN' => '978-5-17-080128-0',
                'publication_publication_language' => 3 // ID языка из таблицы languages
            ],
            [
                'publication_title' => 'Преступление и наказание',
                'publication_author' => 'Достоевский Федор Михайлович',
                'publication_publisher' => 'Санкт-Петербургское издательство',
                'publication_date' => '1866-01-01',
                'publication_page' => 671,
                'publication_ISBN' => '978-5-389-08907-4',
                'publication_publication_language' => 3
            ],
            [
                'publication_title' => 'Анна Каренина',
                'publication_author' => 'Толстой Лев Николаевич',
                'publication_publisher' => 'Русское издательство',
                'publication_date' => '1878-01-01',
                'publication_page' => 864,
                'publication_ISBN' => '978-5-17-085698-3',
                'publication_publication_language' => 3
            ],
            [
                'publication_title' => 'Братья Карамазовы',
                'publication_author' => 'Достоевский Федор Михайлович',
                'publication_publisher' => 'Санкт-Петербургское издательство',
                'publication_date' => '1880-01-01',
                'publication_page' => 824,
                'publication_ISBN' => '978-5-389-08917-3',
                'publication_publication_language' => 3
            ],
            [
                'publication_title' => 'Мастер и Маргарита',
                'publication_author' => 'Булгаков Михаил Афанасьевич',
                'publication_publisher' => 'Советское издательство',
                'publication_date' => '1967-01-01',
                'publication_page' => 480,
                'publication_ISBN' => '978-5-699-87041-9',
                'publication_publication_language' => 3
            ],
            [
                'publication_title' => 'Идиот',
                'publication_author' => 'Достоевский Федор Михайлович',
                'publication_publisher' => 'Санкт-Петербургское издательство',
                'publication_date' => '1869-01-01',
                'publication_page' => 678,
                'publication_ISBN' => '978-5-389-08908-1',
                'publication_publication_language' => 3
            ],
            [
                'publication_title' => 'Отцы и дети',
                'publication_author' => 'Тургенев Иван Сергеевич',
                'publication_publisher' => 'Русское издательство',
                'publication_date' => '1862-01-01',
                'publication_page' => 384,
                'publication_ISBN' => '978-5-17-084376-1',
                'publication_publication_language' => 3
            ],
            [
                'publication_title' => 'Тихий Дон',
                'publication_author' => 'Шолохов Михаил Александрович',
                'publication_publisher' => 'Советское издательство',
                'publication_date' => '1940-01-01',
                'publication_page' => 1024,
                'publication_ISBN' => '978-5-17-108768-2',
                'publication_publication_language' => 3
            ],
            [
                'publication_title' => 'Обломов',
                'publication_author' => 'Гончаров Иван Александрович',
                'publication_publisher' => 'Русское издательство',
                'publication_date' => '1859-01-01',
                'publication_page' => 608,
                'publication_ISBN' => '978-5-17-086785-8',
                'publication_publication_language' => 3
            ],
            [
                'publication_title' => 'The Call of Cthulhu',
                'publication_author' => 'Lovecraft Howard Phillips',
                'publication_publisher' => 'Weird Tales Publishing',
                'publication_date' => '1928-02-01',
                'publication_page' => 168,
                'publication_ISBN' => '978-0-87286-428-5',
                'publication_publication_language' => 1 // ID языка для английского
            ],
            [
                'publication_title' => 'At the Mountains of Madness',
                'publication_author' => 'Lovecraft Howard Phillips',
                'publication_publisher' => 'Weird Tales Publishing',
                'publication_date' => '1936-02-01',
                'publication_page' => 144,
                'publication_ISBN' => '978-1-878252-75-5',
                'publication_publication_language' => 1
            ],
            [
                'publication_title' => 'To Kill a Mockingbird',
                'publication_author' => 'Lee Harper',
                'publication_publisher' => 'J.B. Lippincott & Co.',
                'publication_date' => '1960-07-11',
                'publication_page' => 281,
                'publication_ISBN' => '978-0-06-112008-4',
                'publication_publication_language' => 1
            ],
            [
                'publication_title' => 'The Great Gatsby',
                'publication_author' => 'Fitzgerald F. Scott',
                'publication_publisher' => 'Charles Scribner\'s Sons',
                'publication_date' => '1925-04-10',
                'publication_page' => 180,
                'publication_ISBN' => '978-0-7432-7356-5',
                'publication_publication_language' => 1
            ]
        ]);
    }
}
