<!-- Stored in resources/views/authors.index.blade.php -->

@extends('layouts.app')

@section('title', 'Список авторов')

@section('content')

    <div class="col-lg-12">
        @if (count($authors) > 0)

            <table class="table table-striped">
                        <thead>
                            <th>№</th>
                            <th>ФИО</th>
                            <th>Количество книг</th>
                            <th>Действия</th>
                        </thead>
                        <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->books()->count() }}</td>
                                <td>
                                    <a href="{{ url('authors/' . $author->id . '/edit') }}" class="btn btn-primary">Редактировать</a>
                                    <br><br>
                                    <form action="{{ url('authors/'.$author->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="button" id="delete-author-{{ $author->id }}" class="btn delete btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Удалить
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            <script>
                jQuery('.btn.delete').on('click', function(ev){
                    var r = confirm("Уверены? Удаляем?");
                    if (r == true) {
                        jQuery(this).parents('form').submit();
                    }
                });
            </script>
        @else
            <p>Авторы не найдены</p>
        @endif

        <a href="{{ url('authors/create') }}" class="btn btn-primary">Добавить автора</a>
    </div>
@endsection
