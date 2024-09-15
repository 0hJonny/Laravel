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
        Schema::create('copies', function (Blueprint $table) {
            $table->id('copy_id')->comment('Идентификатор копии (PK)');
            $table->string('copy_inventory_number')->comment('Уникальный номер книги в местной библиотеке')->unique();
            $table->foreignId('copy_publication_id')->constrained('publications', 'publication_id')->onDelete('cascade');
            $table->foreignId('copy_condition_id')->constrained('book_conditions', 'book_condition_id')->onDelete('cascade');
            $table->foreignId('copy_reader_id')->nullable()->constrained('readers', 'reader_id')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['copy_inventory_number', 'copy_publication_id', 'copy_condition_id']);
            $table->comment('Таблица содержит данные о книгах (физических копиях)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copies');
    }
};
