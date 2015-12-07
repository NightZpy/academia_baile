<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function academieParticipant()
    {
    	return $this->hasMany('App\AcademieParticipant');
    }

    public function estate()
    {
    	return $this->belongsTo('App\Estate');
    }

    public function parishes()
    {
    	return $this->hasMany('App\Parish');
    }      

	public function cities()
    {
    	return $this->hasMany('App\City');
    } 
}
