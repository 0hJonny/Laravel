<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_conditions', function (Blueprint $table) {
            $table->id('book_condition_id')->comment('Идентификатор состояния книги (PK)');
            $table->foreignId('boook_condition_name')->constrained('book_wear_coefficients', 'book_wear_coefficient_id')->onDelete('cascade');
            $table->string('book_condition_description')->comment('Описание состояния книги');
            $table->timestamps();
        
            $table->comment('Таблица содержит данные о состояниях книг');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_conditions');
    }
};
