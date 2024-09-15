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
@endsection
