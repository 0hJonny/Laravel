<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        User::factory(10)->create();
        $this->call([
            LanguageSeeder::class,
            BookWearCoefficientSeeder::class,
            BookConditionSeeder::class,
            // UserSeeder::class,
            PublicationSeeder::class,
            ReaderSeeder::class,
            CopiesSeeder::class,
            LoanSeeder::class,
        ]);
        
    }
}

