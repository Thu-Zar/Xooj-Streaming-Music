<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Song;
use App\Artist;
use App\Album;

class SearchdatabaeController extends Controller
{
     public function searches(Request $request)
    {
        //dd($request);
        $searchval = request('searchval');
        

        if($searchval)
        {  
             
            $songs=DB::table('songs')
                ->join('artists','artists.id','=','songs.artist')
                ->where('songs.title','like','%'.$searchval.'%')
                ->select('songs.*','artists.name as artistname')
                ->get();
                //dd($songs);
            // $songs = Song::where('songs.title','like','%'.$searchval.'%')->get();
        }

        return response($songs);

        

    }
    public function searchartists(Request $request)
    {
        //dd($request);
        $searchval = request('searchartist');
        

        if($searchval)
        {  
            $artists = Artist::where('artists.name','like','%'.$searchval.'%')->get(); 
             //dd($artists);
        }

    return response($artists);

        

    }

    public function searchalbums(Request $request)
    {
        $searchval = request('searchalbum');
        
        

        if($searchval)
        {  
            $albums = Album::where('albums.title','like','%'.$searchval.'%')->get(); 
             
        }

    return response($albums);

        

    }
}
