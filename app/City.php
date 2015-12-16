<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
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
}
