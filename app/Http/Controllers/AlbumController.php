<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use App\Models\Album;
use App\Models\Artist;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all();
        return View::make('album.index', compact('albums'));
    }

    public function create() {
        $artists = Artist::all();
        return View::make('album.create', compact('artists'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $album = new Album();
        $album->title = $request->title;
        $album->genre = $request->genre;
        $album->date_released = $request->date_released;
        $album->artist_id = $request->artist_id;
        
        $album->save();
        return Redirect::to('album');
        
        
        
    }

    public function edit($id)
    {
        $album = Album::find($id);
        $artists = Artist::all();
       
        return View::make('album.edit', compact('album', 'artists'));
    }
}
