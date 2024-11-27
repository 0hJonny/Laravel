@extends('layouts.app')

@section('content')
<style>
    .create-copy-container {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .create-copy-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .create-copy-container label {
        font-weight: bold;
        color: #333;
        display: block;
        margin-bottom: 8px;
    }

    .create-copy-container input,
    .create-copy-container select,
    .create-copy-container textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .create-copy-container input:focus,
    .create-copy-container select:focus,
    .create-copy-container textarea:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .create-copy-container .form-group {
        margin-bottom: 20px;
    }

    .create-copy-container .btn-submit {
        display: inline-block;
        width: 100%;
        padding: 10px 15px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .create-copy-container .btn-submit:hover {
        background-color: #0056b3;
    }

    .create-copy-container .error-message {
        color: red;
        font-size: 12px;
        margin-top: -10px;
        margin-bottom: 10px;
    }

    .hidden {
        display: none;
    }
</style>

<div class="create-copy-container">
    <h1>Добавить новую копию книги</h1>

    <form action="{{ route('copies.store') }}" method="POST" id="copyForm">
        @csrf

        <!-- Выбор книги -->
        <div class="form-group">
            <label for="copy_publication_id">Название:</label>
            <select name="copy_publication_id" id="copy_publication_id" required>
                <option value="" disabled selected>Выберите книгу</option>
                @foreach($publications as $publication)
                    <option value="{{ $publication->publication_id }}" {{ old('copy_publication_id') == $publication->publication_id ? 'selected' : '' }}>
                        {{ $publication->publication_title }} ({{ $publication->publication_publisher }})
                    </option>
                @endforeach
            </select>
            @error('copy_publication_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Выбор состояния или добавление нового -->
        <div class="form-group">
            <label for="copy_condition_id">Состояние:</label>
            <select name="copy_condition_id" id="copy_condition_id">
                <option value="" disabled selected>Выберите существующее состояние</option>
                @foreach($conditions as $condition)
                    <option value="{{ $condition->book_condition_id }}" {{ old('copy_condition_id') == $condition->book_condition_id ? 'selected' : '' }}>
                        {{ $condition->book_condition_description }}
                    </option>
                @endforeach
            </select>
            @error('copy_condition_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Коэффициент износа или создание нового -->
        <div class="form-group" id="existingWearCoefficientGroup">
            <label for="new_book_wear_coefficient">Коэффициент износа (новое состояние):</label>
            <select name="new_book_wear_coefficient" id="new_book_wear_coefficient">
                <option value="" disabled selected>Выберите коэффициент износа</option>
                @foreach($wearCoefficients as $coefficient)
                    <option value="{{ $coefficient->book_wear_coefficient_id }}" {{ old('new_book_wear_coefficient') == $coefficient->book_wear_coefficient_id ? 'selected' : '' }}>
                        {{ $coefficient->book_wear_coefficient_name }}
                    </option>
                @endforeach
            </select>
            @error('new_book_wear_coefficient')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="new_condition_description">Описание нового состояния:</label>
            <textarea name="new_condition_description" id="new_condition_description" rows="4" placeholder="Введите описание нового состояния">{{ old('new_condition_description') }}</textarea>
            @error('new_condition_description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Инвентарный номер -->
        <div class="form-group">
            <label for="copy_inventory_number">Инвентарный номер:</label>
            <input type="text" name="copy_inventory_number" id="copy_inventory_number" value="{{ old('copy_inventory_number') }}" required>
            @error('copy_inventory_number')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Добавить</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const descriptionField = document.getElementById('new_condition_description');
        const wearCoefficientGroup = document.getElementById('existingWearCoefficientGroup');

        descriptionField.addEventListener('input', function () {
            if (descriptionField.value.trim() !== '') {
                wearCoefficientGroup.classList.add('hidden');
            } else {
                wearCoefficientGroup.classList.remove('hidden');
            }
        });
    });
</script>
@endsection
