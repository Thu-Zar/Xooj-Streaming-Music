<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Artist;
use App\Album;


class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists=Artist::all();
        return view('backend.artists',compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists=Artist::all();
        return view('artist.create',compact('artists'));
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
                'name' => 'required',
                'gender' => 'required',
                'photo' => 'required',
            ],[
                'name.required' => ' The artist name is required.',
                'gender.required' => ' The gender type is required.',
                'photo.required' => ' The album name is required.',
            ]);


        //file upload
       if($request->hasfile('photo')){
            $photo=$request->file('photo');
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/artist/',$name);
            $photo='/storage/artist/'.$name;
        }else{
            $photo='';
        }


        //Data Insert
        $artist=new Artist();
        $artist->name=request('name') ;
        $artist->gender=request('gender') ;
        $artist->photo=$photo;
        //$post->status=1;
        $artist->save();
        return redirect()->route('artist.index');
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
        {
       $artist=Artist::find($id);
       $albums=Album::all();
        return view('artist.edit',compact('artist','albums'));
    }
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
        $request->validate([
                'name' => 'required|min:5',
                'gender' => 'required',
                'photo' => 'sometimes|mimes:jpeg,png,jpg'
            ],[
                'name.required' => ' The artist name is required.',
                'gender.required' => ' The gender type is required.',
                'photo.required' => ' The photo path is required.',
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

        $artist=Artist::find($id);
        $artist->name=request('name') ;
        $artist->gender=request('gender') ;
        $artist->photo=$photo ;
        
        $artist->save();
        return redirect()->route('artist.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artist=Artist::find($id);
        $artist->delete();
        return redirect()->route('artist.index');
    }
    public function search($id)
    {

        $artists = Artist::find($id);
        $songs = DB::table('songs')
                ->where('songs.album',$id)
                ->select('songs.*')
                ->get();
        //dd($songs);

        
        return view('searchartist',compact('songs','artists'));
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
