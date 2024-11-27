@extends('layouts.app')

@section('content')
<style>
    .add-loan-container {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .add-loan-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .add-loan-container label {
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .add-loan-container input,
    .add-loan-container select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        font-size: 14px;
    }

    .add-loan-container input:focus,
    .add-loan-container select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .add-loan-container .form-group {
        margin-bottom: 20px;
    }

    .add-loan-container .btn-submit {
        display: inline-block;
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

    .add-loan-container .btn-submit:hover {
        background-color: #0056b3;
    }

    .add-loan-container .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }
</style>

<div class="add-loan-container">
    <h1>Добавить новый долг</h1>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="loan_reader_id">Читатель:</label>
            <select name="loan_reader_id" id="loan_reader_id" required>
                @foreach($readers as $reader)
                <option value="{{ $reader->reader_id }}" {{ old('loan_reader_id') == $reader->reader_id ? 'selected' : '' }}>
                    {{ $reader->reader_name }} {{ $reader->reader_surname }}
                </option>
                @endforeach
            </select>
            @error('loan_reader_id')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="loan_copy_id">Экземпляр книги:</label>
            <select name="loan_copy_id" id="loan_copy_id" required>
                @foreach($copies as $copy)
                <option value="{{ $copy->copy_id }}" {{ old('loan_copy_id') == $copy->copy_id ? 'selected' : '' }}>
                    {{ $copy->copy_inventory_number }} - {{ $copy->publication->publication_title }}
                </option>
                @endforeach
            </select>
            @error('loan_copy_id')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="loan_date">Дата выдачи:</label>
            <input type="date" name="loan_date" id="loan_date" value="{{ old('loan_date') }}" required>
            @error('loan_date')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="loan_return_date_plan">Планируемая дата возврата:</label>
            <input type="date" name="loan_return_date_plan" id="loan_return_date_plan" value="{{ old('loan_return_date_plan') }}">
            @error('loan_return_date_plan')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="loan_return_date_actual">Фактическая дата возврата:</label>
            <input type="date" name="loan_return_date_actual" id="loan_return_date_actual" value="{{ old('loan_return_date_actual') }}">
            @error('loan_return_date_actual')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Добавить долг</button>
    </form>
</div>

@endsection