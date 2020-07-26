<?php

namespace App\Http\Controllers;

use App\Election;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('elections.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('elections.create');
    }


    public function list(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $period = $request->period;

        $elections = Election::orderBy($request->sortP, $request->sortD)
            ->when($start_date && !$end_date, function ($query) use ($start_date, $period) {
                return $query->where($period, '>=', $start_date);
            })
            ->when(!$start_date && $end_date, function ($query) use ($end_date, $period) {
                return $query->where($period, '<=', $end_date);
            })
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date, $period) {
                return $query->whereBetween($period, [$start_date, $end_date]);
            })
            ->paginate(10);
        
        return $elections;

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $election = new Election(request(['start_date', 'end_date']));
        $election->save();

        Session::flash('success', 'Votação cadastrada!');

        return redirect(route('elections.index'));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function show(Election $election)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function edit(Election $election)
    {
        //
        return view('elections.edit', compact('election'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Election $election)
    {
        //
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $election->start_date = request('start_date');
        $election->end_date = request('end_date');
        $election->save();

        Session::flash('success', 'Votação atualizada!');

        return redirect(route('elections.index'));
    }

    public function destroy(Election $election)
    {
        $this->delete($election);
        return redirect(route('books.index'));
    }

    public function delete(Election $election)
    {
        // if (auth()->user()->cant('delete', $election)) {
            // return redirect(route('books.index'));
        // }

        $election = Election::findOrFail($election->id);
        $election->delete();
    }
}
