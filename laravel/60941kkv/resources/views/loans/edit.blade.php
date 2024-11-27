@extends('layouts.app')

@section('content')
<style>
    .edit-loan-container {
        font-family: Arial, sans-serif;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .edit-loan-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .edit-loan-container label {
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .edit-loan-container input,
    .edit-loan-container select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        font-size: 14px;
    }

    .edit-loan-container input:focus,
    .edit-loan-container select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .edit-loan-container .form-group {
        margin-bottom: 20px;
    }

    .edit-loan-container .btn-submit {
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

    .edit-loan-container .btn-submit:hover {
        background-color: #0056b3;
    }

    .edit-loan-container .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

</style>

<div class="edit-loan-container">
    <h1>Редактировать долг</h1>

    <form action="{{ route('loans.update', $loan->loan_id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Метод PUT для обновления -->

        <div class="form-group">
            <label for="loan_reader_id">Читатель:</label>
            <select name="loan_reader_id" id="loan_reader_id" required>
                @foreach($readers as $reader)
                    <option value="{{ $reader->reader_id }}" {{ $loan->loan_reader_id == $reader->reader_id ? 'selected' : '' }}>
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
                    <option value="{{ $copy->copy_id }}" {{ $loan->loan_copy_id == $copy->copy_id ? 'selected' : '' }}>
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
            <input type="date" name="loan_date" id="loan_date" value="{{ old('loan_date', $loan->loan_date) }}" required>
            @error('loan_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="loan_return_date_plan">Планируемая дата возврата:</label>
            <input type="date" name="loan_return_date_plan" id="loan_return_date_plan" value="{{ old('loan_return_date_plan', $loan->loan_return_date_plan) }}">
            @error('loan_return_date_plan')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="loan_return_date">Фактическая дата возврата:</label>
            <input type="date" name="loan_return_date" id="loan_return_date" value="{{ old('loan_return_date', $loan->loan_return_date) }}">
            @error('loan_return_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Обновить долг</button>
    </form>
</div>
@endsection
