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
        Schema::create('book_wear_coefficients', function (Blueprint $table) {
            $table->id('book_wear_coefficient_id')->comment('Идентификатор коэффициента износа книги (PK)');
            $table->string('book_wear_coefficient_name')->unique()->comment('Название коэффициента износа книги');
            $table->unsignedInteger('book_wear_coefficient_order')->nullable()->comment('Порядок коэффициента износа книги');
        
            $table->comment('Таблица содержит данные о коэффициентах износа книг');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_wear_coefficients');
    }
};
