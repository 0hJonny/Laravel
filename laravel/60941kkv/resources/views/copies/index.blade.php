@extends('layouts.app')

@section('content')
<style>
    .pagination {
        display: flex;
        justify-content: center;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
        gap: 10px;
        margin-top: 20px;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .pagination .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }



    .table_wrapper {
        max-height: 75vh;
        overflow-y: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
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
                <th>ISBN</th>
                <th>Издательство</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($copies as $copy)
            <tr>
                <td>{{ $copy->publication->publication_title }}</td>
                <td>{{ $copy->Condition->book_condition_description }}</td>
                <td>{{ $copy->publication->publication_ISBN }}</td>
                <td>{{ $copy->publication->publication_publisher }}</td>
                <td>
                    <a href="{{ route('copies.edit', $copy->copy_id) }}">Редактировать</a>
                    <a href="{{ route('copies.duplicate', $copy->copy_id) }}" class="btn btn-info">Копировать</a>
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
<div class="pagination">
    @if ($copies->onFirstPage())
    <span>← Назад</span>
    @else
    <a href="{{ $copies->previousPageUrl() }}">← Назад</a>
    @endif

    @foreach ($copies->getUrlRange(1, $copies->lastPage()) as $page => $url)
    @if ($page == $copies->currentPage())
    <span class="active">{{ $page }}</span>
    @else
    <a href="{{ $url }}">{{ $page }}</a>
    @endif
    @endforeach

    @if ($copies->hasMorePages())
    <a href="{{ $copies->nextPageUrl() }}">Вперед →</a>
    @else
    <span>Вперед →</span>
    @endif
</div>
@endsection