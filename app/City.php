<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function academyParticipant()
    {
    	return $this->hasMany('App\AcademyParticipant');
    }

    public function estate()
    {
    	return $this->belongsTo('App\Estate');
    }
}
