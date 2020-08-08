<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Repositories\BookRepository;

class BookController extends Controller
{
    /** @var BookRepository  */
    protected $books;

    public function __construct(BookRepository $books)
    {
        $this->books = $books;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('books.index', [
            'books' => $this->books->get($request->get('author')),
            'authors' => $this->books->authors(),
            'author_id' => $request->get('author')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.form', ['authors' => $this->books->authors()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'year' => 'required|digits:4|max:' . date("Y"),
            'authors' => 'required|array|min:1',
        ]);
        $this->books->create([
            'name' => $request->get('name'),
            'year' => new \DateTime($request->get('year') . '-01-01'),
            'authors' => $request->get('authors')
        ]);
        return redirect('/books');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $book_authors_ids = [];
        foreach ($book->authors()->get() as $author) {
            $book_authors_ids[] = $author->id;
        }

        return view('books.edit', ['book' => $book, 'book_authors_ids' => $book_authors_ids, 'authors' => $this->books->authors()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'year' => 'required|digits:4|max:' . date("Y"),
            'authors' => 'required|array|min:1'
        ]);

        $this->books->update($book, [
            'name' => $request->get('name'),
            'year' => new \DateTime($request->get('year') . '-01-01'),
            'authors' => $request->get('authors')
        ]);
        return redirect('/books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }
}
