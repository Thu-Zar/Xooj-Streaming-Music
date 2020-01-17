<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;

class SearchController extends Controller
{
    public function search()
    {
    	$songs = Song::all()->random(10);
        return view('search',compact('songs'));
    }
}
