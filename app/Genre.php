<?php

namespace App;
use App\Song;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    Protected $fillable=['name'];

    public function song(){
    	return $this->hasMany('App\Song');
    }
}
