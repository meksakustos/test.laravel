<!-- Stored in resources/views/authors.index.blade.php -->

@extends('layouts.app')

@section('title', 'Список книг')

@section('content')

    <div class="col-lg-12">
        <h3>Фильтр</h3>
        <form action="{{ url('books') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('GET') }}
            <div class="form-group row">
                <label for="filter-author" class="control-label col-md-1">Автор</label>
                <div class="col-md-3">
                    <select name="author" id="filter-author" class="form-control">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" @if($author->id == $author_id) selected @endif>{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" type="submit">Применить</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-12">
        @if (count($books) > 0)

            <table class="table table-striped">
                        <thead>
                            <th>№</th>
                            <th>Название</th>
                            <th>Автор(ы)</th>
                            <th>Год издания</th>
                            <th>Действия</th>
                        </thead>
                        <tbody>
                        @foreach ($books as $books)
                            <tr>
                                <td>{{ $books->id }}</td>
                                <td>{{ $books->name }}</td>
                                <td>
                                    @foreach($books->authors as $author)
                                        <p>{{$author->name}}</p>
                                    @endforeach
                                </td>
                                <td>{{ date("Y", strtotime($books->year)) }}</td>

                                <td>
                                    <a href="{{ url('books/' . $books->id . '/edit') }}" class="btn btn-primary">Редактировать</a>
                                    <br><br>
                                    <form action="{{ url('books/'.$books->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="button" id="delete-book-{{ $books->id }}" class="btn delete btn-danger">
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
            <p>Книги не найдены</p>
        @endif

        <a href="{{ url('books/create') }}" class="btn btn-primary">Добавить книгу</a>
    </div>
@endsection
