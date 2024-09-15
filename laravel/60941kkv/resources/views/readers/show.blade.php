@extends('layouts.app')

@section('content')
    <h1>Информация о читателе</h1>
    <p>Имя: {{ $reader->reader_name }}</p>
    <p>Фамилия: {{ $reader->reader_surname }}</p>
    <p>Отчество: {{ $reader->reader_middle_name }}</p>
    <p>Связанный пользователь: {{ $reader->user->user_name }}</p>
    <a href="{{ route('readers.index') }}">Назад к списку</a>
@endsection
