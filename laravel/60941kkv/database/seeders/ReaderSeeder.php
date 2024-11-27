<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = User::all()->pluck('id')->toArray();

        $readers = [];
        foreach ($users as $userId) {
            $readers[] = [
                'reader_name' => fake()->firstName(),
                'reader_surname' => fake()->lastName(),
                'reader_middle_name' => fake()->optional()->regexify('[A-Z][a-z]{2,15}'),
                'reader_user_id' => $userId,
            ];
        }

        DB::table('readers')->insert($readers);
    }
}

