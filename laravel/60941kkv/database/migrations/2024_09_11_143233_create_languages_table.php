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
        Schema::create('languages', function (Blueprint $table) {
            $table->id('language_id')->comment('Идентификатор языка (PK)');
            $table->string('language_name')->comment('Название языка');
            $table->string('language_short_name')->comment('Сокращенное название языка');
            $table->unsignedInteger('language_order')->nullable()->comment('Порядок языков');

            $table->unique(['language_name', 'language_short_name']);
            $table->comment('Таблица языков');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
