<?php

namespace App;
use App\Song;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
     Protected $fillable=['title','artist','genre','artworkPath'];
     public function song(){
    	return $this->hasMany('App\Song');
    }


}
