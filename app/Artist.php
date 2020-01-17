<?php

namespace App;
use App\Song;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    Protected $fillable=['name','gender','photo'];
    public function song(){
    	return $this->hasMany('App\Song');
    }
}

