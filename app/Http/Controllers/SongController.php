<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Album;
use DB;
use View;
use Validator;


class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //    $songs = Song::all();
        $songs = DB::table('songs')
            ->join('albums', 'albums.id', '=', 'songs.album_id')
            ->select('songs.id', 'songs.title as song_name', 'songs.description', 'albums.title as album_title' )
            ->paginate(15);
        // dd($songs);
        return View::make('song.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albums = Album::all();
        return View::make('song.create', compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'title' => ['required', 'max:30'],
        //     'description' => ['required', 'min:5', 'max:200'],
        //     'album_id' =>'required'
        // ]);
        // dd($request->all());
        $rules = [
            'title' => ['required', 'max:30'],
            'description' => ['required', 'min:5', 'max:200'],
            'album_id' =>'required'
        ];
        $messages = ['title.required' => 'ito ay  kailangan', 'description.required' =>'may laman dapat', 'min' => 'too short'];
        $validator = Validator::make($request->all(), $rules, $messages);
        // dd($validatedData);
        // if ($validator->fails()) {
        //     return redirect('songs/create')
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
         if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
