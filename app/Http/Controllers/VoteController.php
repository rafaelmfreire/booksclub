<?php

namespace App\Http\Controllers;

use App\Book;
use App\Election;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Election $election)
    {
        return view('elections.votes.index', compact('election'));
    }

    public function indexList(Request $request, Election $election)
    {
        // $election_id = $request->election_id;

        // DB::enableQueryLog();

        $result = DB::table('votes')
            ->select('book_id', 'title',
                DB::raw('lpad(sum(vote), 3, "0") as score'))
            ->join('books', 'books.id', '=', 'votes.book_id')
            ->where('election_id', $election->id)
            ->groupByRaw('book_id, title')
            ->get();

        // dd(DB::getQueryLog()); 

        return $result;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Election $election)
    {
        if(auth()->user()->electionsVoted()->contains($election->id)){
            Session::flash('danger', 'Você já registrou seu voto nessa votação');
            return redirect(route('elections.index'));
        }
        $books = Book::all()->where('read', 0);
        return view('elections.votes.create', compact(['election', 'books']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Election $election)
    {
        $uniques = array(1 => null, 2 => null, 3 => null, 4 => null, 5 => null, 6 => null, 7 => null, 8 => null, 9 => null, 10 => null);

        $validator = Validator::make($request->all(), [
            'books' => 'array'
        ]);

        $validator->after(function ($validator) use ($request, $uniques){
            foreach ($request->books as $key => $value) {
                if($value != 0 && $uniques[$value]){
                    $validator->errors()->add('books', 'Você não pode dar a mesma nota para dois livros diferentes');
                }
                $uniques[$value] = true;
            }
        });

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::transaction(function() use($request, $election) {
            foreach ($request->books as $key => $value) {
                $vote = new Vote();
                $vote->election_id = $election->id;
                $vote->user_id = auth()->user()->id;
                $vote->book_id = $key;
                $vote->vote = $value;

                $vote->save();
            }

        });
        Session::flash('success', 'Voto registrado!');

        return redirect(route('elections.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
