<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function academiesParticipants()
    {
    	return $this->hasMany('App\Pluranza\AcademyParticipant');
    }

    public function estate()
    {
    	return $this->belongsTo('App\Estate');
    }

    public function parishes()
    {
    	return $this->hasMany('App\Parish');
    }
}
