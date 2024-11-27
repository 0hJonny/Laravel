@extends('layouts.app')

@section('content')
<style>
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        gap: 10px;
        margin-top: 20px;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        padding: 0.5rem 0.75rem;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .pagination .page-item.active .page-link {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
    }

    .table_wrapper {
        max-height: 75vh;
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

    th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.1);
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 120px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content a,
    .dropdown-content form {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover,
    .dropdown-content form:hover {
        background-color: #ddd;
    }

    .dropdown-content form {
        margin: 0;
    }

    .dropdown-content button {
        background: none;
        border: none;
        color: black;
        text-align: left;
        padding: 12px 16px;
        width: 100%;
        cursor: pointer;
    }

    .dropdown-content button:hover {
        background-color: #ddd;
    }

    .btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        text-align: center;
        white-space: nowrap;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }

    .btn-info {
        color: #fff;
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }

    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin-top: 20px;
        gap: 10px;
    }

    .page-item {
        display: inline-block;
        padding: 8px 12px;
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        background-color: #fff;
        transition: background-color 0.2s, color 0.2s;
    }

    .page-item:hover {
        background-color: #007bff;
        color: #fff;
    }

    .page-item.active {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
        font-weight: bold;
        pointer-events: none;
    }

    .page-item.disabled {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #dee2e6;
        pointer-events: none;
    }
</style>

<div class="d-flex justify-content-between align-items-center">
<h1>Издания</h1>
<form method="GET" action="{{ route('publications.index') }}" class="form-inline mb-3 float-right">
        <label for="per_page">Элементов на странице:</label>
        <select name="per_page" id="per_page" class="form-control ml-2" onchange="this.form.submit()">
            @foreach([5, 10, 15, 20] as $value)
                <option value="{{ $value }}" {{ request('per_page') == $value ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </form>
</div>

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
                <td><a href="{{ route('publications.show', $publication->publication_id) }}" class="btn btn-info">Подробнее</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if ($publications->lastPage() > 1)
    <div class="pagination">
        @if ($publications->onFirstPage())
            <span class="page-item disabled">← Назад</span>
        @else
            <a href="{{ $publications->previousPageUrl() }}" class="page-item">← Назад</a>
        @endif

        @foreach ($publications->getUrlRange(1, $publications->lastPage()) as $page => $url)
            @if ($page == $publications->currentPage())
                <span class="page-item active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="page-item">{{ $page }}</a>
            @endif
        @endforeach

        @if ($publications->hasMorePages())
            <a href="{{ $publications->nextPageUrl() }}" class="page-item">Вперед →</a>
        @else
            <span class="page-item disabled">Вперед →</span>
        @endif
    </div>
@endif

@endsection
