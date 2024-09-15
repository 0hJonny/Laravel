@extends('layouts.app')

@section('content')
    <h1>Информация о выдаче книги</h1>
    <p>Читатель: {{ $loan->reader->reader_name }} {{ $loan->reader->reader_surname }}</p>
    <p>Книга: {{ $loan->copy->publication->publication_title }}</p>
    <p>Инвентарный номер: {{ $loan->copy->copy_inventory_number }}</p>
    <p>ISBN: {{ $loan->copy->publication->publication_ISBN }}</p>
    <p>Дата выдачи: {{ $loan->loan_date }}</p>
    <p>Планируемая дата возврата: {{ $loan->loan_return_date_plan }}</p>
    <p>Фактическая дата возврата: {{ $loan->loan_return_date_actual ?: 'Не возвращена' }}</p>
    <a href="{{ route('loans.index') }}">Назад к списку</a>
@endsection
