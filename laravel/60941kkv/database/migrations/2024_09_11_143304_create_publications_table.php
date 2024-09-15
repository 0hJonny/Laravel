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
        Schema::create('publications', function (Blueprint $table) {
            $table->id('publication_id')->comment('Идентификатор публикации (PK)');
            $table->string('publication_title')->comment('Название публикации');
            $table->string('publication_author')->comment('Автор публикации');
            $table->string('publication_publisher')->comment('Издательство');
            $table->date('publication_date')->comment('Дата публикации');
            $table->unsignedInteger('publication_page')->comment('Количество страниц');
            $table->string('publication_ISBN')->comment('ISBN');
            $table->foreignId('publication_publication_language')->constrained('languages', 'language_id')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['publication_title', 'publication_author', 'publication_publisher', 'publication_date', 'publication_page', 'publication_ISBN']);
            $table->comment('Таблица содержит данные об изданиях');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
