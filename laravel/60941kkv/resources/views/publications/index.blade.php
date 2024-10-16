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
<h1>Издания</h1>
<div class="table_wrapper">
    <table>
        <thead>
            <tr>
                <th>Название</th>
                <th>Автор</th>
                <th>Издатель</th>
                <th>Дата издания</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($publications as $publication)
            <tr>
                <td>{{ $publication->publication_title }}</td>
                <td>{{ $publication->publication_author }}</td>
                <td>{{ $publication->publication_publisher }}</td>
                <td>{{ $publication->publication_date }}</td>
                <td><a href="{{ route('publications.show', $publication->publication_id) }}">Подробнее</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pagination">
    @if ($publications->onFirstPage())
    <span>← Назад</span>
    @else
    <a href="{{ $publications->previousPageUrl() }}">← Назад</a>
    @endif

    @foreach ($publications->getUrlRange(1, $publications->lastPage()) as $page => $url)
    @if ($page == $publications->currentPage())
    <span class="active">{{ $page }}</span>
    @else
    <a href="{{ $url }}">{{ $page }}</a>
    @endif
    @endforeach

    @if ($publications->hasMorePages())
    <a href="{{ $publications->nextPageUrl() }}">Вперед →</a>
    @else
    <span>Вперед →</span>
    @endif
</div>
@endsection