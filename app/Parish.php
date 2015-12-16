<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
	/*
	* -------------------------- Relations ------------------------
	*/
    public function academiesParticipants()
    {
    	return $this->hasMany('App\Pluranza\AcademyParticipant');
    }

    public function municipality()
    {
        return $this->belongsTo('App\Municipality');
    }
}
