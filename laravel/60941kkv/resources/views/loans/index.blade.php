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
@endsection
