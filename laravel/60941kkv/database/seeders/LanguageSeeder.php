<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            ['language_name' => 'Английский (США)', 'language_short_name' => 'en-US'],
            ['language_name' => 'Английский (Великобритания)', 'language_short_name' => 'en-GB'],
            ['language_name' => 'Русский', 'language_short_name' => 'ru-RU'],
            ['language_name' => 'Испанский (Испания)', 'language_short_name' => 'es-ES'],
            ['language_name' => 'Испанский (Мексика)', 'language_short_name' => 'es-MX'],
            ['language_name' => 'Немецкий', 'language_short_name' => 'de-DE'],
            ['language_name' => 'Французский', 'language_short_name' => 'fr-FR'],
            ['language_name' => 'Китайский (упрощённый)', 'language_short_name' => 'zh-CN'],
            ['language_name' => 'Китайский (традиционный)', 'language_short_name' => 'zh-TW'],
            ['language_name' => 'Японский', 'language_short_name' => 'ja-JP'],
            ['language_name' => 'Итальянский', 'language_short_name' => 'it-IT'],
            ['language_name' => 'Португальский (Бразилия)', 'language_short_name' => 'pt-BR'],
            ['language_name' => 'Португальский (Португалия)', 'language_short_name' => 'pt-PT'],
            ['language_name' => 'Арабский', 'language_short_name' => 'ar-SA'],
            ['language_name' => 'Корейский', 'language_short_name' => 'ko-KR'],
            ['language_name' => 'Индонезийский', 'language_short_name' => 'id-ID'],
            ['language_name' => 'Турецкий', 'language_short_name' => 'tr-TR'],
            ['language_name' => 'Голландский', 'language_short_name' => 'nl-NL'],
            ['language_name' => 'Шведский', 'language_short_name' => 'sv-SE'],
            ['language_name' => 'Польский', 'language_short_name' => 'pl-PL'],
        ]);
    }
}
