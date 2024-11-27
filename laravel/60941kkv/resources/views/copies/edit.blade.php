@extends('layouts.app')

@section('content')
<style>
    .edit-copy-container {
        font-family: Arial, sans-serif;
    }

    .edit-copy-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .edit-copy-form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .edit-copy-form div {
        margin-bottom: 15px;
    }

    .edit-copy-form label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    .edit-copy-form select,
    .edit-copy-form input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        font-size: 14px;
    }

    .edit-copy-form select:focus,
    .edit-copy-form input:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .edit-copy-form .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    .edit-copy-form button {
        display: inline-block;
        width: 100%;
        padding: 10px 15px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
    }

    .edit-copy-form button:hover {
        background-color: #0056b3;
    }
</style>

<div class="edit-copy-container">
    <h1>Редактировать экземпляр книги</h1>

    <form class="edit-copy-form" action="{{ route('copies.update', $copy->copy_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="copy_publication_id">Название:</label>
            <select name="copy_publication_id" id="copy_publication_id">
                @foreach($publications as $publication)
                    <option value="{{ $publication->publication_id }}" {{ $copy->copy_publication_id == $publication->publication_id ? 'selected' : '' }}>
                        {{ $publication->publication_title }}
                    </option>
                @endforeach
            </select>
            @error('copy_publication_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="copy_condition_id">Состояние:</label>
            <select name="copy_condition_id" id="copy_condition_id">
                @foreach($conditions as $condition)
                    <option value="{{ $condition->book_condition_id }}" {{ $copy->copy_condition_id == $condition->book_condition_id ? 'selected' : '' }}>
                        {{ $condition->book_condition_description }}
                    </option>
                @endforeach
            </select>
            @error('copy_condition_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="copy_inventory_number">Инвентарный номер:</label>
            <input type="text" name="copy_inventory_number" id="copy_inventory_number" value="{{ $copy->copy_inventory_number }}">
            @error('copy_inventory_number')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Обновить</button>
    </form>
</div>
@endsection
