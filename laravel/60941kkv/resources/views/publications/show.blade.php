@extends('layouts.app')

@section('content')
<style>
    .publication-info-container {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .publication-info-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .publication-info-container p {
        font-size: 16px;
        line-height: 1.6;
        color: #555;
    }

    .publication-info-container p strong {
        font-weight: bold;
        color: #333;
    }

    .publication-info-container .btn-back {
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

    .publication-info-container .btn-back:hover {
        background-color: #0056b3;
    }

    .publication-info-container .publication-details {
        margin-top: 20px;
        padding: 15px;
        border-radius: 4px;
        background-color: #e9ecef;
        border: 1px solid #ccc;
    }

    .publication-info-container .publication-details p {
        margin-bottom: 10px;
    }

    .publication-info-container .publication-details p:last-child {
        margin-bottom: 0;
    }

</style>

<div class="publication-info-container">
    <h1>Информация об издании</h1>

    <div class="publication-details">
        <p><strong>Название:</strong> {{ $publication->publication_title }}</p>
        <p><strong>Автор:</strong> {{ $publication->publication_author }}</p>
        <p><strong>Издатель:</strong> {{ $publication->publication_publisher }}</p>
        <p><strong>Дата издания:</strong> {{ $publication->publication_date }}</p>
        <p><strong>Язык:</strong> {{ $publication->language->language_name }}</p>
        <p><strong>Количество страниц:</strong> {{ $publication->publication_page }}</p>
        <p><strong>ISBN:</strong> {{ $publication->publication_ISBN }}</p>
    </div>

    <a href="{{ route('publications.index') }}" class="btn-back">Назад к списку</a>
</div>

@endsection
