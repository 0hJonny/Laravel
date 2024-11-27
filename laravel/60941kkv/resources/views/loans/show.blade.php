@extends('layouts.app')

@section('content')
<style>
    .loan-info-container {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .loan-info-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .loan-info-container p {
        font-size: 16px;
        line-height: 1.6;
        color: #555;
    }

    .loan-info-container p strong {
        font-weight: bold;
        color: #333;
    }

    .loan-info-container .btn-back {
        display: inline-block;
        padding: 10px 15px;
        margin-top: 20px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        text-align: center;
        text-decoration: none;
    }

    .loan-info-container .btn-back:hover {
        background-color: #0056b3;
    }

    .loan-info-container .loan-details {
        margin-top: 20px;
        padding: 15px;
        border-radius: 4px;
        background-color: #e9ecef;
        border: 1px solid #ccc;
    }

    .loan-info-container .loan-details p {
        margin-bottom: 10px;
    }

    .loan-info-container .loan-details p:last-child {
        margin-bottom: 0;
    }

</style>

<div class="loan-info-container">
    <h1>Информация о выдаче книги</h1>

    <div class="loan-details">
        <p><strong>Читатель:</strong> {{ $loan->reader->reader_name }} {{ $loan->reader->reader_surname }}</p>
        <p><strong>Книга:</strong> {{ $loan->copy->publication->publication_title }}</p>
        <p><strong>Инвентарный номер:</strong> {{ $loan->copy->copy_inventory_number }}</p>
        <p><strong>ISBN:</strong> {{ $loan->copy->publication->publication_ISBN }}</p>
        <p><strong>Дата выдачи:</strong> {{ $loan->loan_date }}</p>
        <p><strong>Планируемая дата возврата:</strong> {{ $loan->loan_return_date_plan }}</p>
        <p><strong>Фактическая дата возврата:</strong> {{ $loan->loan_return_date_actual ?: 'Не возвращена' }}</p>
    </div>

    <a href="{{ route('loans.index') }}" class="btn-back">Назад к списку</a>
</div>

@endsection
