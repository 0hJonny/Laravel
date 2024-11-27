@extends('layouts.app')

@section('content')
<style>
    .copy-details-container {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .copy-details-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .copy-details-container table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .copy-details-container th,
    .copy-details-container td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .copy-details-container th {
        background-color: #f2f2f2;
    }

    .btn-back {
        display: inline-block;
        padding: 10px 15px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-back:hover {
        background-color: #0056b3;
    }
</style>

<div class="copy-details-container">
    <h1>Информация о экземпляре книги</h1>

    <table>
        <tr>
            <th>Название</th>
            <td>{{ $copy->publication->publication_title }}</td>
        </tr>
        <tr>
            <th>Состояние</th>
            <td>{{ $copy->Condition->book_condition_description }}</td>
        </tr>
        <tr>
            <th>Инвентарный номер</th>
            <td>{{ $copy->copy_inventory_number }}</td>
        </tr>
        <tr>
            <th>ISBN</th>
            <td>{{ $copy->publication->publication_ISBN }}</td>
        </tr>
        <tr>
            <th>Издательство</th>
            <td>{{ $copy->publication->publication_publisher }}</td>
        </tr>
    </table>

    <a href="{{ route('copies.index') }}" class="btn-back">Назад</a>
</div>
@endsection
