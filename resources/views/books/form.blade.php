<!-- Stored in resources/views/authors.index.blade.php -->

@extends('layouts.app')

@section('title', 'Добавление книги')

@section('content')

    <div class="col-lg-12">

        @include('common.errors')

        <form action="{{ url('books') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

            <div class="form-group">
                <label for="book-name" class="col-sm-3 control-label">Название</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="book-name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="book-year" class="col-sm-3 control-label">Год издания</label>
                <div class="col-sm-6">
                    <input type="text" name="year" id="book-year" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="book-authors" class="col-sm-3 control-label">Авторы</label>
                <div class="col-sm-6">
                    <select multiple name="authors[]" id="book-authors" class="form-control">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Добавить книгу
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
