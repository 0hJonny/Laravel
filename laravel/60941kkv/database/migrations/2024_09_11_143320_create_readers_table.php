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
        Schema::create('readers', function (Blueprint $table) {
            $table->id('reader_id')->comment('Идентификатор читателя (PK)');
            $table->string('reader_name')->comment('Имя читателя');
            $table->string('reader_surname')->comment('Фамилия читателя');
            $table->string('reader_middle_name')->nullable()->comment('Отчество читателя');
            $table->timestamps();

            $table->comment('Таблица содержит данные о читателях');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('readers');
    }
};
