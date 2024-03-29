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
            ->select('songs.id', 'songs.title as song_name', 'songs.description', 'albums.title as album_title')
            ->orderBy('songs.id', 'DESC')
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
        // dd($request->description);
        $rules = [
            'title' => ['required', 'max:30'],
            'description' => ['required', 'min:5', 'max:200'],
            'album_id' => 'required'
        ];
        $messages = ['title.required' => 'ito ay  kailangan', 'description.required' => 'may laman dapat', 'min' => 'too short'];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // $validatedData = $request->validate([
        //     'title' => ['required', 'max:30'],
        //     'description' => ['required', 'min:5', 'max:200'],
        //     'album_id' =>'required'
        // ]);
        // dd($request->all());
        // dd($validatedData);
        // if ($validator->fails()) {
        //     return redirect('songs/create')
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
        $song = Song::create([
            'title' => $request->title,
            'description' => $request->description,
            'album_id' => $request->album_id
        ]);
        return redirect()->route('songs.index');
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
        $song = Song::find($id);
        $album = Album::where('id', $song->album_id)->first();
        // dd($album);
        // $albums = Album::all();
        $albums = Album::where('id', '<>', $song->album_id)->get();

        return View::make('song.edit', compact('albums', 'song', 'album'));
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
        // dd($request);
        $rules = [
            'title' => ['required', 'max:30'],
            'description' => ['required', 'min:5', 'max:200'],
            'album_id' => 'required'
        ];
        $messages = ['title.required' => 'ito ay  kailangan', 'description.required' => 'may laman dapat', 'min' => 'too short'];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $song = Song::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'album_id' => $request->album_id
        ]);
        return redirect()->route('songs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $song = Song::destroy($id);
        return redirect()->back();
    }

    public function search(Request $request)
    {
        // dd($request);
        $results = DB::table('songs')
            ->join('albums','albums.id', '=', 'songs.album_id')
            ->join('artists','artists.id', '=', 'albums.artist_id')
            ->where('songs.title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
            ->select('albums.title as album_title', 'songs.id', 'songs.title as song_title', 'songs.description', 'artists.name')
            ->get();
        // dd($results);
        return view('song.search', compact('results'));
    }
}
