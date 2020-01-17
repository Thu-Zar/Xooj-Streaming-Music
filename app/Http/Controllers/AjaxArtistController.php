<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Artist;

class AjaxArtistController extends Controller
{
    public function artistUpdate(Request $request){
    	/*$data= $request->all();*/

    	$id = request('artistId');

    	$artist=Artist::find($id);

    	return response()->json(array('artname'=>$artist),200);
    }
}
