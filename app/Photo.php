<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**************SET RIGHT PATH******************/
    protected $uploads = '/images/';
    protected $fillable = ['file'];
	
	public function getFileAttribute($photo){
	    /**************ISSUE WITH URL BECAUSE RETURN http******************/
		//return url('/') . $this->uploads . $photo;
		return $this->uploads . $photo;
	}
	
}
