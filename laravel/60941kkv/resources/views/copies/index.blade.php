@extends('layouts.app')

@section('content')
<style>
.table_wrapper {
    max-height: 75vh;
    overflow-y: auto;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 1rem;
    text-align: center;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
tbody {
    overflow-y: scroll;
}
</style>
    <h1>Список экземпляров книг</h1>

    <a href="{{ route('copies.create') }}">Добавить новый экземпляр</a>
    <div class="table_wrapper">
    <table>
        <thead>
            <tr>
                <th>Название</th>
                <th>Состояние</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($copies as $copy)
                <tr>
                    <td>{{ $copy->publication->publication_title }}</td>
                    <td>{{ $copy->Condition->book_condition_description }}</td>
                    <td>
                        <a href="{{ route('copies.edit', $copy->copy_id) }}">Редактировать</a>
                        <form action="{{ route('copies.destroy', $copy->copy_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить эту копию?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection