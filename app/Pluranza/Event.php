<?php

namespace App\Pluranza;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function estate()
    {
    	return $this->belongsTo('App\Estate');
    }

    public function Municipality()
    {
    	return $this->belongsTo('App\Municipality');
    }

    public function Parish()
    {
    	return $this->belongsTo('App\Parish');
    }      

	public function City()
    {
    	return $this->belongsTo('App\City');
    } 
}
