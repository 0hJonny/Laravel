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
    <h1>Читатели</h1>
    <div class="table_wrapper">
    <table>
        <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Отчество</th>
                <th>Пользователь</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($readers as $reader)
                <tr>
                    <td>{{ $reader->reader_name }}</td>
                    <td>{{ $reader->reader_surname }}</td>
                    <td>{{ $reader->reader_middle_name }}</td>
                    <td>{{ $reader->user->user_name }}</td>
                    <td><a href="{{ route('readers.show', $reader->reader_id) }}">Подробнее</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
