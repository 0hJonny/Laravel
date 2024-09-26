@extends('layouts.app')

@section('content')
    <h1>Добавить новую копию книги</h1>

    <form action="{{ route('copies.store') }}" method="POST">
        @csrf

        <div>
            <label for="copy_publication_id">Название:</label>
            <select name="copy_publication_id" id="copy_publication_id">
                @foreach($publications as $publication)
                    <option value="{{ $publication->publication_id }}" {{ old('copy_publication_id') == $publication->publication_id ? 'selected' : '' }}>
                        {{ $publication->publication_title }}
                    </option>
                @endforeach
            </select>
            @error('copy_publication_id')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="copy_condition_id">Состояние:</label>
            <select name="copy_condition_id" id="copy_condition_id">
                @foreach($conditions as $condition)
                    <option value="{{ $condition->book_condition_id }}" {{ old('copy_condition_id') == $condition->book_condition_id ? 'selected' : '' }}>
                        {{ $condition->book_condition_description }}
                    </option>
                @endforeach
            </select>
            @error('copy_condition_id')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="copy_inventory_number">Инвентарный номер:</label>
            <input type="text" name="copy_inventory_number" id="copy_inventory_number" value="{{ old('copy_inventory_number') }}">
            @error('copy_inventory_number')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Добавить</button>
    </form>
@endsection
