<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Album;
class AjaxAlbumController extends Controller
{
    public function albumUpdate(Request $request){
    	/*$data= $request->all();*/

    	$id = request('albumId');

    	$album=Album::find($id);

    	return response()->json(array('albname'=>$album),200);
    }
}
