@extends('layouts.layout')

@section('title', 'Список всех статей')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-3">Список статей</h1>
        @if ($articles->count())
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Заголовок</th>
                        <th scope="col">Автор</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Статья</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <th scope="row">{{ $article->title }}</th>
                            <td>{{ $article->author }}</td>
                            <td>{{ $article->description }}</td>
                            <td>{{ $article->text }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $articles->onEachSide(2)->links() }}
            </div>
        @else
            <div class="text-center">
                <p>Список статей пуст....</p>
            </div>
        @endif
        <div class="text-center">
            <hr>
            <a href="{{ route('articles.create') }}" class="text-center mt-2">Добавить новую статью</a>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        
        
    });
</script>
