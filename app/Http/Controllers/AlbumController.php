<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Album;
use App\Genre;
use App\Artist;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums=Album::all();
        return view('backend.albums',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists=Artist::all();
       $genres=Genre::all();
        return view('album.create',compact('artists','genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'title' => 'required|min:5',
                'artist' => 'required',
                'genre' => 'required',
                'photo' => 'required'
            ],[
                'title.required' => ' The title name is required.',
                'artist.required' => ' The artist name is required.',
                'genre.required' => ' The genre is required.',
                'photo.required' => ' The song path is required.',
            ]);


         //file upload
       if($request->hasfile('photo')){
            $photo=$request->file('photo');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/album/',$name);
            $photo='/storage/album/'.$name;
        }else{
            $photo='';
        }


        //Data Insert
        $album=new Album();
        $album->title=request('title') ;
        $album->artist=request('artist') ;
        $album->genre= request('genre');
        $album->artworkPath=$photo;
        //$post->status=1;
        $album->save();
        return redirect()->route('album.index');
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
       $album=Album::find($id);
       $artists=Artist::all();
       $genres=Genre::all();
        return view('album.edit',compact('album','artists','genres'));
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
        //dd($request);
            $request->validate([
                'title' => 'required|min:5',
                'artist' => 'required',
                'genre' => 'required',
                'artworkPath' => 'sometimes|mimes:jpeg,png,jpg'
            ],[
                'title.required' => ' The album name is required.',
                'artist.required' => ' The artist name is required.',
                'genre.required' => ' The genre is required.',
                'artworkPath.required' => ' The photo path is required.',
            ]);

        //file upload
        if($request->hasfile('photo')){
            $photo=$request->file('photo');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/image/',$name);
            $photo='/storage/image/'.$name;
        }else{
            $photo=request('oldphoto');
        }

        $album=Album::find($id);
        $album->title=request('title') ;
        $album->artist=request('artist') ;
        $album->genre=request('genre') ;
        $album->artworkPath=$photo ;
        
        $album->save();
        return redirect()->route('album.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album=Album::find($id);
        $album->delete();
        return redirect()->route('album.index');
    }
    public function search($id)
    {

        $albums = Album::find($id);
        $artists = Artist::find($id);
        $songs = DB::table('songs')
                ->where('songs.album',$id)
                ->select('songs.*')
                ->get();
        //dd($songs);

        
        return view('searchalbum',compact('albums','songs','artists'));
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
