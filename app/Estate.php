<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function academyParticipant()
    {
    	return $this->hasMany('App\AcademyParticipant');
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
