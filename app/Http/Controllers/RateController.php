<?php

namespace App\Http\Controllers;

use App\Book;
use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        if(auth()->user()->booksRated()->contains($book->id)){
            $rate = Rate::where('book_id', $book->id)->first();
            return redirect(route('books.rates.show', compact('book', 'rate')));
        }
        return view('books.rates.create', compact('book'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
    {
        //
        $validator = Validator::make($request->all(), [
            'rate' => 'required',
            'comments' => 'nullable',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rate = new Rate();
        DB::transaction(function() use($request, $book, $rate) {
            $nota = $request->rate * 10;
            
            $rate->comment = $request->comment;
            $rate->user_id = auth()->user()->id;
            $rate->book_id = $book->id;
            $rate->rate = $nota;
            $rate->save();

            $book->read = 1;
            $book->update();

            Session::flash('success', 'Avaliação feita!');
        });

        return redirect(route('books.rates.show', compact('book', 'rate')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, Rate $rate)
    {
        return view('books.rates.show', compact('book', 'rate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        //
    }
}
