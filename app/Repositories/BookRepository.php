<?php

namespace App\Repositories;

use App\Book;
use App\Author;

class BookRepository
{
    public function get($author)
    {
        if($author) {
            return Book::whereHas('authors', function($q) use ($author) {
                $q->where('author_id', '=', $author);
            })->get();
        }
        return Book::orderBy('name', 'asc')
            ->get();
    }

    public function create($params)
    {
        $book = new Book;
        $book->fill($params);
        $book->save();
        $book->authors()->attach($params['authors']);
        return $book;
    }

    public function update($book, $params)
    {
        $book->update($params);
        $book->authors()->sync($params['authors']);
        return $book;
    }

    public function authors()
    {
        return Author::get();
    }
}
