<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function academieParticipant()
    {
    	return $this->hasMany('App\AcademieParticipant');
    }

    public function municipalities()
    {
    	return $this->hasMany('App\Municipality');
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
