<?php

namespace App\Repositories;

use App\Author;

class AuthorRepository
{
    public function get()
    {
        return Author::orderBy('name', 'asc')
            ->get();
    }

    public function create($params)
    {
        return Author::create($params);
    }

    public function update($author, $params)
    {
        return $author->update($params);
    }
}
