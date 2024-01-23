<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::paginate(10);
        
        // $data['artists'] = $artists;

        return View::make('artist.index', compact('artists'));
    }

    public function create()
    {
        return View::make('artist.create');
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $country = $request->country;
        $image = $request->image;
        $artist = new Artist();
        $artist->name = $name;
        $artist->country = $country;
        $artist->img_path = $image;
        $artist->save();
        return Redirect::to('artist');
        
        
        // dd($request->country, $request->name, $request->image);
    }

    public function edit($id)
    {
        $artist = Artist::find($id);
        // dd($artist->name, $artist->country);
        return View::make('artist.edit', compact('artist'));
    }

    public function update(Request $request, $id)
   
    {
        // dd($request, $id);
        $artist = Artist::find($id);
        $artist->name = $request->name;
        $artist->country = $request->country;
        $artist->img_path = $request->image;
        $artist->save();
        return Redirect::to('artist');
    }

    public function delete($id)
    {
        Artist::destroy($id);
        return Redirect::to('artist');
    }
}
