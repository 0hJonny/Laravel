@extends('layouts.app')

@section('content')
<style>
    .copy-record-container {
        font-family: Arial, sans-serif;
    }

    .copy-record-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .copy-record-form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .copy-record-form .form-group {
        margin-bottom: 15px;
    }

    .copy-record-form label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    .copy-record-form select,
    .copy-record-form input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        font-size: 14px;
    }

    .copy-record-form select:focus,
    .copy-record-form input:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .copy-record-form button {
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

    .copy-record-form button:hover {
        background-color: #0056b3;
    }
</style>

<div class="copy-record-container">
    <h1>Копирование записи</h1>

    <form class="copy-record-form" action="{{ route('copies.storeDuplicate') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="copy_inventory_number">Инвентарный номер</label>
            <input type="text" name="copy_inventory_number" class="form-control" value="{{ old('copy_inventory_number', $new_inventory_number) }}" required>
        </div>

        <div class="form-group">
            <label for="copy_publication_id">Издание</label>
            <select name="copy_publication_id" class="form-control" required>
                @foreach ($copy->Publication->all() as $publication)
                    <option value="{{ $publication->publication_id }}" {{ old('copy_publication_id', $copy->copy_publication_id) == $publication->publication_id ? 'selected' : '' }}>
                        {{ $publication->publication_title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="copy_condition_id">Состояние</label>
            <select name="copy_condition_id" class="form-control" required>
                @foreach ($copy->Condition->all() as $condition)
                    <option value="{{ $condition->book_condition_id }}" {{ old('copy_condition_id', $copy->copy_condition_id) == $condition->book_condition_id ? 'selected' : '' }}>
                        {{ $condition->book_condition_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Создать копию</button>
    </form>
</div>
@endsection
