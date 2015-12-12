<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
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
}
