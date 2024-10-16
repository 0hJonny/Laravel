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
<h1>Выданные книги</h1>
<div class="table_wrapper">
    <table>
        <thead>
            <tr>
                <th>Читатель</th>
                <th>Название книги</th>
                <th>Дата выдачи</th>
                <th>Планируемая дата возврата</th>
                <th>Фактическая дата возврата</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td>{{ $loan->reader->reader_name }} {{ $loan->reader->reader_surname }}</td>
                <td>{{ $loan->copy->publication->publication_title }}</td>
                <td>{{ $loan->loan_date }}</td>
                <td>{{ $loan->loan_return_date_plan }}</td>
                <td>{{ $loan->loan_return_date_actual ?: 'Не возвращена' }}</td>
                <td><a href="{{ route('loans.show', $loan->loan_id) }}">Подробнее</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pagination">
    @if ($loans->onFirstPage())
    <span>← Назад</span>
    @else
    <a href="{{ $loans->previousPageUrl() }}">← Назад</a>
    @endif

    @foreach ($loans->getUrlRange(1, $loans->lastPage()) as $page => $url)
    @if ($page == $loans->currentPage())
    <span class="active">{{ $page }}</span>
    @else
    <a href="{{ $url }}">{{ $page }}</a>
    @endif
    @endforeach

    @if ($loans->hasMorePages())
    <a href="{{ $loans->nextPageUrl() }}">Вперед →</a>
    @else
    <span>Вперед →</span>
    @endif
</div>
@endsection