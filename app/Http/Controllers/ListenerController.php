<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Validator; 
use DB;
use Auth;

use App\Models\Listener;
use App\Models\Album;

class ListenerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $listeners = Listener::all();
        $listeners = Listener::withTrashed()->get();
        
        return view('listener.index', compact('listeners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listener.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file('img_path'));
        $rules = [
            'img_path' => 'mimes:jpg,bmp,png',
           
        ];
       
        $validator = Validator::make($request->all(), $rules);
        
         if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $listener = new Listener();
        $listener->name = $request->last_name . ' ' . $request->first_name;
        $listener->address = $request->address;
        // $path = Storage::putFile('images', $request->file('img_path'));
        //   dd($path);
        // $path = $request->file('img_path')->store('images');
        $name = $request->file('img_path')->getClientOriginalName();
        $extension =$request->file('img_path')->getClientOriginalExtension();

        $path = Storage::putFileAs(
            'public/images',
            $request->file('img_path'),
            $name
        );
        $listener->img_path = 'storage/images/'.$name;
        $listener->save();
        return redirect()->route('listeners.index');
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
        $listener = Listener::find($id);
        return view('listener.edit', compact('listener'));
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
        if($request->file('img_path')) {
            $path = Storage::putFileAs(
                'public/images',
                $request->file('img_path'),
                $request->file('img_path')->getClientOriginalName()
            );
            $listener = Listener::where('id', $id)->update([
                'name' => $request->name,
                'address' => $request->address,
                'img_path' => 'storage/images/'.$request->file('img_path')->getClientOriginalName()
            ]);
        }
        else {
            $listener = Listener::where('id', $id)->update([
                'name' => $request->name,
                'address' => $request->address
            ]);
        }
        return redirect()->route('listeners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Listener::destroy($id);
        return redirect()->route('listeners.index');
    }

    public function restore($id) {
        $listener = Listener::withTrashed()->where('id', $id)->restore();
        return redirect()->route('listeners.index');
    }

    public function addAlbums() {
        $albums = Album::all();
        // dd(Auth::user()->id);
        // dd(Auth::id());
        // dd($albums);
    
        return view('listener.add_album', compact('albums'));
    }

    public function addAlbumListener(Request $request) {
    //    dd($request->album);
   
        // $listener_id = 5;
        $listener = Listener::where('user_id',Auth::id())->first();
        // dd($listener);
        foreach($request->album as $album_id) {
            // dump($album_id);
            DB::table('album_listener')->insert([
                'album_id' => $album_id,
                'listener_id' => $listener->id,
                'created_at' => now()
            ]);
        }
        // dd($request->album);
        return redirect()->route('listeners.index');
    }

    public function editAlbumListener()
    {
        $listener = Listener::where('user_id', Auth::id())
            ->select('id')
            ->first();
            // dd($listener);
        $myAlbums = DB::table('albums')->join('album_listener', 'albums.id', '=', 'album_listener.album_id')->where('listener_id', $listener->id)->pluck('albums.id')->toArray();
        // dd($myAlbums);
        
        // dump($myAlbums->id);
        // dd($myAlbums);
        $albums = Album::all();
        // dd($albums);
       
        return view('listener.edit_album', compact('listener', 'myAlbums', 'albums'));
    }

    public function updateAlbums(Request $request)
    {
        // dd($request->album_id);
        $listener = Listener::where('user_id', Auth::id())->select('id')->first();
        // dd($listener->id);
        $deleted = DB::table('album_listener')->where('listener_id', $listener->id)->delete();
        if (!empty($request->album_id)) {
            foreach ($request->album_id as $album_id) {
                DB::table('album_listener')->insert([
                    'album_id' => $album_id,
                    'listener_id' => $listener->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        return redirect()->route('listeners.editAlbumListener');
    }
}

//composer require laravel/ui
// php artisan ui bootstrap --auth
// npm install 
// npm run dev
// npm run dev
