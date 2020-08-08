<!-- Stored in resources/views/authors.index.blade.php -->

@extends('layouts.app')

@section('title', 'Редактирование автора')

@section('content')

    <div class="col-lg-12">

        @include('common.errors')

        <form action="{{ route('authors.update', $author->id) }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="author" class="col-sm-3 control-label">ФИО</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="author-name" class="form-control" value="{{ $author->name }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Сохранить изменения
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection
