<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Song;

class AjaxController extends Controller
{
    public function songUpdate(Request $request){
    	/*$data= $request->all();*/

    	$id = request('songId');

    	$song=Song::find($id);

    	return response()->json(array('msg'=>$song),200);
    }
    
    

}
