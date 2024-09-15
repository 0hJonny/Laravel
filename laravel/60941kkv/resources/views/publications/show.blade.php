@extends('layouts.app')

@section('content')
    <h1>Информация об издании</h1>
    <p>Название: {{ $publication->publication_title }}</p>
    <p>Автор: {{ $publication->publication_author }}</p>
    <p>Издатель: {{ $publication->publication_publisher }}</p>
    <p>Дата издания: {{ $publication->publication_date }}</p>
    <p>Язык: {{ $publication->language->language_name }}</p>
    <p>Количество страниц: {{ $publication->publication_page }}</p>
    <p>ISBN: {{ $publication->publication_ISBN }}</p>
    <a href="{{ route('publications.index') }}">Назад к списку</a>
@endsection
