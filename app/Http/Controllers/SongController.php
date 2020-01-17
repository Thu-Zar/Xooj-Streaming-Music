<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Song;
use App\Album;
use App\Artist;
use App\Genre;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs=Song::all();
        return view('backend.songs',compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists=Artist::all();
        //dd($artists);
       $albums=Album::all();
       $genres=Genre::all();
        return view('song.create',compact('artists','albums','genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
                'title' => 'required|min:5',
                'artist' => 'required',
                'album' => 'required',
                'genre' => 'required',
                'duration' => 'required',
                 'mp3' => 'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,acc'
            ],[
                'title.required' => ' The title name is required.',
                'artist.required' => ' The artist name is required.',
                'album.required' => ' The album name is required.',
                'genre.required' => ' The genre is required.',
                'duration.required' => ' The duration name is required.',
                'mp3.required' => ' The song path is required.',
            ]);


        //file upload
       $songfile = $request->file('path');
       $path='';

       if($songfile != null)
       {
        $filenamewithExt=$songfile->getClientOriginalName();

        $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);

        $extension=$songfile->getClientOriginalExtension();

        $fileNameToStore=rand(11111,99999).'.'.$extension;

        $songfile->move(public_path().'/storage/audio'.$fileNameToStore);

        $path='/storage/audio'.$fileNameToStore;
       }


        //Data Insert
        $song=new Song();
        $song->title=request('title') ;
        $song->artist=request('artist') ;
        $song->album=request('album');
        $song->genre= request('genre');
        $song->duration=request('duration');
        $song->path=$path;
        //$post->status=1;
        $song->save();
        return redirect()->route('song.index');

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
       $song=Song::find($id);
       $artists=Artist::all();
       $albums=Album::all();
       $genres=Genre::all();
        return view('song.edit',compact('song','artists','albums','genres'));
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
        // dd($request->file('mp3'));
        $request->validate([
                'title' => 'required|min:5',
                'artist' => 'required',
                'album' => 'required',
                'genre' => 'required',
                'duration' => 'required',
                 'mp3' => 'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,acc'
            ],[
                'title.required' => ' The title name is required.',
                'artist.required' => ' The artist name is required.',
                'album.required' => ' The album name is required.',
                'genre.required' => ' The genre is required.',
                'duration.required' => ' The duration name is required.',
                'mp3.required' => ' The song path is required.',
            ]);


        $songfile = $request->file('mp3');
       $path='';

       if($songfile != null)
       {
        $filenamewithExt=$songfile->getClientOriginalName();

        $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);

        $extension=$songfile->getClientOriginalExtension();

        $fileNameToStore=rand(11111,99999).'.'.$extension;

        $songfile->move(public_path().'/storage/audio'.$fileNameToStore);

        $path='/storage/audio'.$fileNameToStore;
       }else{
            $path=request('oldsong');
        }

        //dd($music_file);
        $song=Song::find($id);
        $song->title=request('title') ;
        $song->artist=request('artist') ;
        $song->album=request('album') ;
        $song->genre=request('genre') ;
        $song->duration=request('duration') ;
        $song->path=$path;
        
        $song->save();
        return redirect()->route('song.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $song=Song::find($id);
        $song->delete();
        return redirect()->route('song.index');
    }
    public function download($id){
        //PDF file is stored under project/public/download/info.pdf
        $songs = DB::table('songs')
                ->where('songs.id',$id)
                ->select('songs.path')
                ->first();

        $path = $songs->path;
          // dd($path);
        return response()->download($path);
        //return Response::download($songs);
}
}
