<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Redirect;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all();
        return View::make('album.index', compact('albums'));
    }
}
