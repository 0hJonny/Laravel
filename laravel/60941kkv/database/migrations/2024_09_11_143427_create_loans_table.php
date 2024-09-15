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
        Schema::create('loans', function (Blueprint $table) {
            $table->id('loan_id')->comment('Идентификатор выдачи (PK)');
            $table->foreignId('loan_copy_id')->constrained('copies', 'copy_id')->onDelete('cascade');
            $table->foreignId('loan_reader_id')->constrained('readers', 'reader_id')->onDelete('cascade');
            $table->date('loan_date')->comment('Дата выдачи');
            $table->date('loan_return_date')->nullable()->comment('Дата возврата');
            $table->date('loan_return_date_plan')->nullable()->comment('Планируемая дата возврата'); // Добавляем этот столбец
            $table->timestamps();

            $table->unique(['loan_copy_id', 'loan_reader_id']);
            $table->comment('Таблица содержит данные о выдачах книг');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
