<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books.index');
    }

    public function list(Request $request)
    {
        $title = $request->title;
        $author = $request->author;

        $books = Book::with('user')
                    ->when($title, function($q, $title){
                        return $q->where('title', 'like', '%'.$title.'%');
                    })
                    ->when($author, function($q, $author){
                        return $q->where('author', 'like', '%'.$author.'%');
                    })
                    ->orderBy($request->sortP, $request->sortD)
                    ->paginate(10);
        
        return $books;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'nullable'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $book = new Book(request(['title', 'author']));
        $book->user_id = auth()->user()->id;
        $book->save();

        Session::flash('success', 'Livro adicionado à lista de leitura!');

        return redirect(route('books.index'));
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
        //
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
        //
    }

    public function destroy(Book $book)
    {
        $this->delete($book);
        return redirect(route('books.index'));
    }

    public function delete(Book $book)
    {
        // if (auth()->user()->cant('delete', $book)) {
            // return redirect(route('books.index'));
        // }

        $book = Book::findOrFail($book->id);
        $book->delete();
    }

}
