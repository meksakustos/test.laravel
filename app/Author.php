<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name'];

    /**
     * Книги, написаные автором
     *
     */
    public function books()
    {
        return $this->belongsToMany('App\Book', 'book_author');
    }
}
