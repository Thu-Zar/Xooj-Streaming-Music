<?php

namespace App;
use App\Album;
use App\Artist;
use App\Genre;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    Protected $fillable=['title','artist','album','genre','duration','path','albumOrder','plays'];

    public function album(){
    	return $this->belongsTo('App\Album');
    }

public function artist(){
    	return $this->belongsTo('App\Artist');
    }

public function genre(){
    	return $this->belongsTo('App\Genre');
    }

  


}
