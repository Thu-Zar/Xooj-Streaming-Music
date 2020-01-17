<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Song;

class AjaxSongCountController extends Controller
{
    public function countUpdate(Request $request){
    	/*$data= $request->all();*/

    	$id = request('countId');

    	$song=Song::find($id);
    	$song->increment('plays');
    	$song->save();
    	return response()->json(array('msg'=>'success'),200);
    	
    }
}
