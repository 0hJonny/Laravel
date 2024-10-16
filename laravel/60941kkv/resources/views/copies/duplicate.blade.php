@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Копирование записи</h1>

    <form action="{{ route('copies.storeDuplicate') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="copy_inventory_number">Инвентарный номер</label>
            <input type="text" name="copy_inventory_number" class="form-control" value="{{ old('copy_inventory_number', $new_inventory_number) }}" required>
        </div>

        <div class="form-group">
            <label for="copy_publication_id">Издание</label>
            <select name="copy_publication_id" class="form-control" required>
                @foreach ($copy->Publication->all() as $publication)
                    <option value="{{ $publication->publication_id }}" {{ old('copy_publication_id', $copy->copy_publication_id) == $publication->publication_id ? 'selected' : '' }}>{{ $publication->publication_title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="copy_condition_id">Состояние</label>
            <select name="copy_condition_id" class="form-control" required>
                @foreach ($copy->Condition->all() as $condition)
                    <option value="{{ $condition->book_condition_id }}" {{ old('copy_condition_id', $copy->copy_condition_id) == $condition->book_condition_id ? 'selected' : '' }}>{{ $condition->book_condition_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Создать копию</button>
    </form>
</div>
@endsection
